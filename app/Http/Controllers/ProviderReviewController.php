<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProviderReview;
use App\Models\ServiceProvider;
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

            
            if ($provider->user_id == $user->id) {
                return redirect()->route('provider-details', ['id' => $provider->slug])
                    ->with('error', 'You cannot rate or comment on your own profile.');
            }

            $existingReview = ProviderReview::where('provider_id', $provider->id)
                ->where('user_id', $user->id)
                ->first();

            if ($existingReview) {
                $existingReview->update([
                    'rating' => $request->rating,
                    'comment' => $request->comment
                ]);
                return redirect()->route('provider-details', ['id' => $provider->slug])
                    ->with('success', 'Your review has been updated.');
            }

            $review = ProviderReview::create([
                'provider_id' => $provider->id,
                'user_id' => $user->id,
                'rating' => $request->rating,
                'comment' => $request->comment
            ]);

            $this->ReputationPointService->updateReputationBasedOnUserReviews($provider, $request->rating);

            return redirect()->route('provider-details', ['id' => $provider->slug])
                ->with('success', 'Your review has been submitted.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'There was an error while submitting your review: ' . $e->getMessage());
        }
    }

}
