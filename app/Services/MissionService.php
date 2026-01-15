<?php

namespace App\Services;

use App\Models\Mission;
use App\Models\MissionOffer;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class MissionService
{
    protected ReputationPointService $reputationService;

    public function __construct(ReputationPointService $reputationService)
    {
        $this->reputationService = $reputationService;
    }

    /**
     * Get user's missions with filters.
     */
    public function getUserMissions(User $user, ?string $status = null): \Illuminate\Database\Eloquent\Collection
    {
        $query = Mission::where('requester_id', $user->id)
            ->orderByDesc('created_at');

        if ($status) {
            $query->where('status', $status);
        }

        return $query->get();
    }

    /**
     * Get available missions for providers.
     */
    public function getAvailableMissions(): \Illuminate\Database\Eloquent\Collection
    {
        return Mission::with('requester')
            ->where('status', 'published')
            ->where('payment_status', 'unpaid')
            ->whereNull('selected_provider_id')
            ->orderByDesc('created_at')
            ->get();
    }

    /**
     * Cancel a mission.
     */
    public function cancelMission(Mission $mission, User $user, string $cancelledBy, ?string $reason = null): array
    {
        // Verify ownership
        if ($cancelledBy === 'requester' && $mission->requester_id !== $user->id) {
            return ['success' => false, 'message' => 'Unauthorized', 'code' => 403];
        }

        // Check if can be cancelled
        if (in_array($mission->status, ['completed', 'cancelled'])) {
            return ['success' => false, 'message' => 'Mission cannot be cancelled', 'code' => 400];
        }

        // Handle refund if needed
        if ($mission->payment_status === 'paid' && $cancelledBy === 'requester') {
            // Refund logic would go here
            $mission->payment_status = 'refunded';
        }

        $mission->status = 'cancelled';
        $mission->cancelled_by = $cancelledBy;
        $mission->cancelled_on = Carbon::now();
        $mission->cancellation_reason = $reason;
        $mission->save();

        Log::info('Mission cancelled', [
            'mission_id' => $mission->id,
            'cancelled_by' => $cancelledBy,
            'user_id' => $user->id,
        ]);

        return ['success' => true, 'message' => 'Mission cancelled successfully'];
    }

    /**
     * Start a mission.
     */
    public function startMission(Mission $mission, User $provider): array
    {
        if ($mission->status !== 'waiting_to_start') {
            return ['success' => false, 'message' => 'Mission cannot be started', 'code' => 400];
        }

        // Verify provider is assigned
        $serviceProvider = $provider->serviceProvider;
        if (!$serviceProvider || $mission->selected_provider_id !== $serviceProvider->id) {
            return ['success' => false, 'message' => 'Unauthorized', 'code' => 403];
        }

        $mission->status = 'in_progress';
        $mission->started_at = Carbon::now();
        $mission->save();

        return ['success' => true, 'message' => 'Mission started successfully', 'mission' => $mission];
    }

    /**
     * Complete a mission.
     */
    public function completeMission(Mission $mission, User $provider): array
    {
        if ($mission->status !== 'in_progress') {
            return ['success' => false, 'message' => 'Mission is not in progress', 'code' => 400];
        }

        $serviceProvider = $provider->serviceProvider;
        if (!$serviceProvider || $mission->selected_provider_id !== $serviceProvider->id) {
            return ['success' => false, 'message' => 'Unauthorized', 'code' => 403];
        }

        $mission->status = 'completed';
        $mission->completed_at = Carbon::now();
        $mission->save();

        // Update reputation
        $this->reputationService->updateReputationPointsBasedOnCompletedMission($serviceProvider);

        return ['success' => true, 'message' => 'Mission completed successfully', 'mission' => $mission];
    }

    /**
     * Accept an offer for a mission.
     */
    public function acceptOffer(MissionOffer $offer, User $requester): array
    {
        $mission = $offer->mission;

        // Verify ownership
        if ($mission->requester_id !== $requester->id) {
            return ['success' => false, 'message' => 'Unauthorized', 'code' => 403];
        }

        // Check mission status
        if ($mission->status !== 'published') {
            return ['success' => false, 'message' => 'Mission is not available', 'code' => 400];
        }

        // Accept this offer
        $offer->status = 'accepted';
        $offer->save();

        // Reject other offers
        MissionOffer::where('mission_id', $mission->id)
            ->where('id', '!=', $offer->id)
            ->update(['status' => 'rejected']);

        // Update mission
        $mission->selected_provider_id = $offer->provider_id;
        $mission->save();

        return [
            'success' => true,
            'message' => 'Offer accepted successfully',
            'offer' => $offer,
            'mission' => $mission,
        ];
    }

    /**
     * Get mission statistics for a user.
     */
    public function getUserMissionStats(User $user): array
    {
        $missions = Mission::where('requester_id', $user->id);

        return [
            'total' => $missions->count(),
            'published' => (clone $missions)->where('status', 'published')->count(),
            'in_progress' => (clone $missions)->where('status', 'in_progress')->count(),
            'completed' => (clone $missions)->where('status', 'completed')->count(),
            'cancelled' => (clone $missions)->where('status', 'cancelled')->count(),
        ];
    }

    /**
     * Get provider's job statistics.
     */
    public function getProviderJobStats(User $provider): array
    {
        $serviceProvider = $provider->serviceProvider;

        if (!$serviceProvider) {
            return ['total' => 0, 'completed' => 0, 'in_progress' => 0];
        }

        $missions = Mission::where('selected_provider_id', $serviceProvider->id);

        return [
            'total' => $missions->count(),
            'completed' => (clone $missions)->where('status', 'completed')->count(),
            'in_progress' => (clone $missions)->where('status', 'in_progress')->count(),
            'waiting' => (clone $missions)->where('status', 'waiting_to_start')->count(),
        ];
    }
}
