<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mission;
use App\Models\UlixaiReview;
use App\Models\ProviderReview;
use App\Models\ReputationPoint;
use App\Services\PaymentService;
use App\Services\ReputationPointService;
class ReviewsController extends Controller
{
    protected $paymentService;
    protected $ReputationPointService;
    public function __construct(PaymentService $paymentService, ReputationPointService $ReputationPointService)
    {
        $this->paymentService = $paymentService;
        $this->ReputationPointService = $ReputationPointService;
    }
    public function reviews(Request $request) {
        $missionId = $request->query('id');
        $mission = Mission::find($missionId);
        $provider = $mission ? $mission->selectedProvider : null;
        return view('dashboard.payments.reviews', compact('mission', 'provider'));
    }
    
    public function reviewUlysse(Request $request) {
        // Validate the input
        $user = Auth::user();
        $missionId = $request->query('mission');
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'service_success' => 'required|in:yes,no',
            'comment' => 'nullable|string|max:500',
            'provider_attribute' => 'nullable|string',
        ]);

        $mission = Mission::findOrFail($missionId);

        if ($mission->status !== 'completed' && $mission->payment_status !== 'paid') {
            return redirect()->back()->with('error', 'Mission must be completed and paid before leaving a review.');
        }
        $provider = $mission->selectedProvider;
        
        if (!$provider) {
            return redirect()->back()->with('error', 'No provider selected for this mission.');
        }

        $transfer = $this->paymentService->transferFunds($mission, $provider);
        if ($transfer['message']) {
            return redirect()->back()->with('error', 'Unable to move Funds. Provider has not completed the KYC');
        }
        // Store the review
        $review = new ProviderReview();
        $review->mission_id = $missionId;
        $review->provider_id = $provider->id;
        $review->user_id = $mission->requester_id;
        $review->rating = $validated['rating'];
        $review->service_success = $validated['service_success'] === 'yes' ? true : false;
        $review->comment = $validated['comment'];
        $review->attributes = $validated['provider_attribute'];
        $review->save();


        // Reputation Points
        $this->ReputationPointService->updateReputationPointsBasedOnMissionCompletedWithReviews($provider);

        $mission->update(['payment_status' => 'released', 'status' => 'completed']);

        $review = UlixaiReview::where('review_by', $user->id)->first();

        if ($review) {
            return redirect()->route('user.service.requests')->with('success', 'Thank you for using Ulixai.');
        }

        return view('dashboard.payments.review-ulysse');
    }

    public function reviewOptions(Request $request) {
        return view('dashboard.payments.review-options');
    }

    public function reviewEnd(Request $request) {
        return view('dashboard.payments.review-end');
    }
}
