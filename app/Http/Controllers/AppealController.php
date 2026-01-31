<?php

namespace App\Http\Controllers;

use App\Services\Global_Moderations\AppealService;
use App\Services\Global_Moderations\Models\UserAppeal;
use Illuminate\Http\Request;

class AppealController extends Controller
{
    public function __construct(
        private AppealService $appealService
    ) {}

    /**
     * Affiche le formulaire de création d'appel
     */
    public function create()
    {
        $user = auth()->user();

        // Vérifier si l'utilisateur peut faire appel
        if (!$user->canAppeal()) {
            return redirect()->route('banned')
                ->with('error', __('notifications.moderation.cannot_appeal'));
        }

        // Appels précédents
        $previousAppeals = UserAppeal::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('pages.appeal', compact('previousAppeals'));
    }

    /**
     * Enregistre un nouvel appel
     */
    public function store(Request $request)
    {
        $request->validate([
            'reason' => 'required|string|min:50|max:2000',
            'evidence' => 'nullable|string|max:2000',
            'agreement' => 'required|accepted',
        ], [
            'reason.min' => __('notifications.moderation.reason_min_length'),
            'agreement.accepted' => __('notifications.moderation.agreement_required'),
        ]);

        $user = auth()->user();

        // Vérifier si l'utilisateur peut faire appel
        if (!$user->canAppeal()) {
            return back()->with('error', __('notifications.moderation.cannot_appeal'));
        }

        // Vérifier si un appel est déjà en cours
        $pendingAppeal = UserAppeal::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'under_review'])
            ->first();

        if ($pendingAppeal) {
            return back()->with('error', __('notifications.moderation.appeal_pending'));
        }

        // Créer l'appel
        $appeal = $this->appealService->createAppeal(
            $user,
            $request->reason,
            $request->evidence
        );

        return redirect()->route('banned')
            ->with('success', __('notifications.moderation.appeal_submitted'));
    }
}
