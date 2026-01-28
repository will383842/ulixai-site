<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mission;
use Illuminate\Support\Facades\Auth;

class DisputeUserController extends Controller
{
    /**
     * Affiche les litiges de l'utilisateur (demandeur ou prestataire)
     */
    public function index()
    {
        $user = Auth::user();
        $providerId = optional($user->serviceProvider)->id;

        // Litiges en tant que demandeur
        $disputesAsRequester = Mission::with(['selectedProvider.user', 'transactions', 'cancellationReasons'])
            ->where('requester_id', $user->id)
            ->where('status', 'disputed')
            ->orderByDesc('updated_at')
            ->get();

        // Litiges en tant que prestataire
        $disputesAsProvider = collect();
        if ($providerId) {
            $disputesAsProvider = Mission::with(['requester', 'transactions', 'cancellationReasons'])
                ->where('selected_provider_id', $providerId)
                ->where('status', 'disputed')
                ->orderByDesc('updated_at')
                ->get();
        }

        // Litiges résolus (historique)
        $resolvedDisputes = Mission::with(['requester', 'selectedProvider.user', 'transactions', 'cancellationReasons'])
            ->where(function ($q) use ($user, $providerId) {
                $q->where('requester_id', $user->id);
                if ($providerId) {
                    $q->orWhere('selected_provider_id', $providerId);
                }
            })
            ->whereIn('status', ['cancelled', 'completed'])
            ->whereIn('payment_status', ['refunded', 'released'])
            ->whereNotNull('cancelled_by')
            ->orderByDesc('updated_at')
            ->limit(10)
            ->get();

        return view('dashboard.my-disputes', [
            'disputesAsRequester' => $disputesAsRequester,
            'disputesAsProvider' => $disputesAsProvider,
            'resolvedDisputes' => $resolvedDisputes,
        ]);
    }

    /**
     * Affiche le détail d'un litige
     */
    public function show($missionId)
    {
        $user = Auth::user();
        $providerId = optional($user->serviceProvider)->id;

        $mission = Mission::with([
            'requester',
            'selectedProvider.user',
            'transactions',
            'cancellationReasons',
            'offers' => function ($q) {
                $q->where('status', 'accepted');
            }
        ])->findOrFail($missionId);

        // Vérifier que l'utilisateur a accès à ce litige
        $isRequester = $mission->requester_id === $user->id;
        $isProvider = $providerId && $mission->selected_provider_id === $providerId;

        if (!$isRequester && !$isProvider) {
            abort(403, 'Accès non autorisé');
        }

        return view('dashboard.dispute-detail', [
            'mission' => $mission,
            'isRequester' => $isRequester,
            'isProvider' => $isProvider,
        ]);
    }
}
