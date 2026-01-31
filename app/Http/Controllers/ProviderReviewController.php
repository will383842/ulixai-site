<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProviderReview;
use App\Models\ServiceProvider;
use App\Models\Mission;
use Illuminate\Support\Facades\Auth;
use App\Services\ReputationPointService;

class ProviderReviewController extends Controller
{
    protected $ReputationPointService;

    public function __construct(ReputationPointService $ReputationPointService)
    {
        $this->ReputationPointService = $ReputationPointService;
    }

    public function store(Request $request, $providerId)
    {
        try {
            $request->validate([
                'rating' => 'required|integer|min:1|max:5',
                'comment' => 'nullable|string|max:1000'
            ]);

            $provider = ServiceProvider::findOrFail($providerId);
            $user = Auth::user();

            // Empêcher de noter son propre profil
            if ($provider->user_id == $user->id) {
                return redirect()->route('provider-details', ['id' => $provider->slug])
                    ->with('error', 'You cannot rate or comment on your own profile.');
            }

            // Vérifier si l'utilisateur a une mission complétée avec ce prestataire
            $completedMission = Mission::where('requester_id', $user->id)
                ->where('selected_provider_id', $provider->id)
                ->where('status', 'completed')
                ->latest()
                ->first();

            $existingReview = ProviderReview::where('provider_id', $provider->id)
                ->where('user_id', $user->id)
                ->first();

            if ($existingReview) {
                $existingReview->update([
                    'rating' => $request->rating,
                    'comment' => $request->comment,
                    'mission_id' => $completedMission?->id ?? $existingReview->mission_id,
                ]);
                return redirect()->route('provider-details', ['id' => $provider->slug])
                    ->with('success', 'Your review has been updated.');
            }

            // Créer la review avec mission_id si disponible (review vérifiée)
            $review = ProviderReview::create([
                'provider_id' => $provider->id,
                'user_id' => $user->id,
                'rating' => $request->rating,
                'comment' => $request->comment,
                'mission_id' => $completedMission?->id,
            ]);

            // Mettre à jour les points de réputation uniquement pour les reviews vérifiées
            if ($completedMission) {
                $this->ReputationPointService->updateReputationBasedOnUserReviews($provider, $request->rating);
            }

            return redirect()->route('provider-details', ['id' => $provider->slug])
                ->with('success', 'Your review has been submitted.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'There was an error while submitting your review: ' . $e->getMessage());
        }
    }
}
