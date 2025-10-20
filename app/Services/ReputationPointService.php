<?php

namespace App\Services;
use App\Models\ReputationPoint;
use App\Models\Badge;
use App\Models\UserBadge;
use Illuminate\Support\Facades\Log;

class ReputationPointService
{
 public function updateReputationPointsBasedOnMissionCompletedWithReviews($provider)
 {
     try {
        $reputationPoint = ReputationPoint::first();
        $provider->increment('points', $reputationPoint->mission_with_review);
        // $provider->update(['points' => $provider->points + $reputationPoint->mission_with_review]);

        $this->updateUlysseStatus($provider);
     } catch (\Exception $e) {
         Log::error("Failed to update reputation points for provider ID: {$providerId}. Error: {$e->getMessage()}");
     }
 }

 public function updateReputationBasedOnUserReviews($provider, $rating) {
    try {
        $reputationPoint = ReputationPoint::first();
        if($rating >= 5 ) {
            $provider->increment('points', $reputationPoint->five_star_review);
            //  $provider->update(['points' => $provider->points + $reputationPoint->five_star_review]);
        }
       
        if($rating > 4 && $rating < 5 ) {
            $provider->increment('points', $reputationPoint->four_star_review);
            //  $provider->update(['points' => $provider->points + $reputationPoint->four_star_review]);
        }
        $this->updateUlysseStatus($provider);
     } catch (\Exception $e) {
         Log::error("Failed to update reputation points for provider ID: {$providerId}. Error: {$e->getMessage()}");
     }
 }


 public function updateReputationPointsBasedOnMissionCancellationByProvider($provider) {
    
    $reputationPoint = ReputationPoint::first();

    $provider->decrement('points', $reputationPoint->provider_canceled);
    $this->updateUlysseStatus($provider);
 }

 public function updateReputationPointsBasedOnDisputeResolvedByProvider($provider) {
    
    $reputationPoint = ReputationPoint::first();
    $provider->decrement('points', $reputationPoint->dispute_refund);
    $this->updateUlysseStatus($provider);
 }

 public function updateUlysseStatus($provider)
    {
        try {
            
            $autoBadges = Badge::where('type', 'reputation')->where('is_auto', true)->get();
            foreach ($autoBadges as $badge) {
                $provider->user->badges()->detach($badge->id);
            }

            $badge = Badge::where('type', 'reputation')
                ->where('is_auto', true)
                ->where('threshold', '<=', $provider->points)
                ->orderByDesc('threshold')
                ->first();

            if ($badge) {
                UserBadge::updateOrCreate(
                    [
                        'user_id' => $provider->user_id,
                        'badge_id' => $badge->id,
                    ],
                    [
                        'assigned_by' => 'system',
                        'assigned_at' => now(),
                        'revoked_at' => null,
                    ]
                );
                $provider->update(['ulysse_status' => $badge->title]);
            } else {
                $provider->update(['ulysse_status' => null]);
            }
        } catch (\Exception $e) {
            \Log::error("Failed to update reputation badge for provider ID: {$provider->id}. Error: {$e->getMessage()}");
        }
    }

    public function updateUlysseStatusManually($provider)
    {
        try {
            
            $autoBadges = Badge::where('type', 'reputation')->where('is_auto', true)->get();
            foreach ($autoBadges as $badge) {
                $provider->user->badges()->detach($badge->id);
            }

            $badge = Badge::where('type', 'reputation')
                ->where('is_auto', true)
                ->where('threshold', '<=', $provider->points)
                ->orderByDesc('threshold')
                ->first();
                
            if ($badge) {
                UserBadge::updateOrCreate(
                    [
                        'user_id' => $provider->user_id,
                        'badge_id' => $badge->id,
                    ],
                    [
                        'assigned_by' => auth()->user()->user_role === 'super_admin' ? 'admin' : auth()->user()->user_role,
                        'assigned_at' => now(),
                        'revoked_at' => null,
                    ]
                );
                $provider->update(['ulysse_status' => $badge->title]);
            } else {
                $provider->update(['ulysse_status' => null]);
            }
        } catch (\Exception $e) {
            \Log::error("Failed to update reputation badge for provider ID: {$provider->id}. Error: {$e->getMessage()}");
        }
    }
}