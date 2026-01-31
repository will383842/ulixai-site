<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Global_Moderations\ModerationService;
use App\Services\Global_Moderations\ReportService;
use App\Services\Global_Moderations\AppealService;
use App\Services\Global_Moderations\SpamDetector;
use App\Models\Mission;
use App\Models\MissionOffer;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ModerationApiController extends Controller
{
    public function __construct(
        private ModerationService $moderationService,
        private ReportService $reportService,
        private AppealService $appealService,
        private SpamDetector $spamDetector
    ) {}

    /**
     * Vérifie si l'utilisateur peut publier (limites quotidiennes)
     */
    public function canPublish(Request $request): JsonResponse
    {
        $type = $request->input('type', 'mission');
        $result = $this->moderationService->canUserPublish(auth()->user(), $type);

        return response()->json($result);
    }

    /**
     * Pré-validation du contenu en temps réel
     */
    public function quickCheck(Request $request): JsonResponse
    {
        $request->validate([
            'content' => 'required|string|max:10000',
        ]);

        $result = $this->moderationService->quickCheck($request->content);

        return response()->json($result);
    }

    /**
     * Soumet un signalement
     */
    public function submitReport(Request $request): JsonResponse
    {
        $request->validate([
            'type' => 'required|in:mission,offer,message,user',
            'id' => 'required|integer',
            'reason' => 'required|string|in:inappropriate,spam,harassment,fraud,other',
            'description' => 'nullable|string|max:1000',
        ]);

        $content = $this->resolveReportable($request->type, $request->id);

        if (!$content) {
            return response()->json([
                'success' => false,
                'message' => 'content_not_found',
            ], 404);
        }

        $result = $this->reportService->submitReport(
            auth()->user(),
            $content,
            $request->reason,
            $request->description
        );

        return response()->json($result);
    }

    /**
     * Soumet un appel
     */
    public function submitAppeal(Request $request): JsonResponse
    {
        $request->validate([
            'reason' => 'required|string|max:2000',
            'evidence' => 'nullable|string|max:5000',
        ]);

        $result = $this->appealService->submitAppeal(
            auth()->user(),
            $request->reason,
            $request->evidence
        );

        return response()->json($result);
    }

    /**
     * Vérifie si l'utilisateur peut faire appel
     */
    public function canAppeal(): JsonResponse
    {
        $result = $this->appealService->canAppeal(auth()->user());

        return response()->json($result);
    }

    /**
     * Récupère le statut de modération de l'utilisateur
     */
    public function getUserStatus(): JsonResponse
    {
        $user = auth()->user();

        return response()->json([
            'status' => $user->status,
            'is_banned' => $user->isBanned(),
            'is_suspended' => $user->isSuspended(),
            'strike_count' => $user->strike_count,
            'trust_score' => $user->trust_score,
            'can_appeal' => $user->can_appeal,
            'appeal_until' => $user->appeal_until,
            'ban_reason' => $user->status !== 'active' ? $user->ban_reason : null,
        ]);
    }

    /**
     * Récupère les strikes actifs de l'utilisateur
     */
    public function getMyStrikes(): JsonResponse
    {
        $strikes = auth()->user()->activeStrikes()
            ->select('id', 'reason', 'strike_number', 'expires_at', 'created_at')
            ->orderBy('created_at', 'desc')
            ->get();

        $maxStrikes = config('moderations.strikes.max_before_ban', 3);

        return response()->json([
            'strikes' => $strikes,
            'count' => $strikes->count(),
            'max' => $maxStrikes,
            'remaining' => $maxStrikes - $strikes->count(),
        ]);
    }

    /**
     * Récupère les limites de publication
     */
    public function getPublishLimits(): JsonResponse
    {
        $user = auth()->user();

        return response()->json([
            'mission' => $this->spamDetector->canCreate($user, 'mission'),
            'offer' => $this->spamDetector->canCreate($user, 'offer'),
            'message' => $this->spamDetector->canCreate($user, 'message'),
        ]);
    }

    /**
     * Résout le modèle à signaler
     */
    private function resolveReportable(string $type, int $id): ?\Illuminate\Database\Eloquent\Model
    {
        return match ($type) {
            'mission' => Mission::find($id),
            'offer' => MissionOffer::find($id),
            'user' => \App\Models\User::find($id),
            default => null,
        };
    }
}
