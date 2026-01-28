<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;  
use App\Models\Mission;
use App\Models\MissionOffer;
use App\Models\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Refund;
use Stripe\Transfer;
use Stripe\Account as StripeAccount;
use App\Services\ReputationPointService;
use App\Services\CurrencyService;
use App\Http\Resources\MissionResource;
use App\Http\Resources\MissionOfferResource;
use App\Http\Requests\Mission\StoreOfferRequest;
use Illuminate\Support\Facades\Gate;

class JobListController extends Controller
{
    protected $ReputationPointService;
    
    public function __construct(ReputationPointService $ReputationPointService)
    {
        $this->ReputationPointService = $ReputationPointService;
    }
    
    public function index(Request $request)
    {
        $provider = auth()->user()->serviceProvider;
        $jobs = [];
        $offers = [];
       
        if ($provider) {
            // Missions where provider's offer is accepted and is under work
            $jobs = Mission::where('selected_provider_id', $provider->id)
                ->whereIn('status', ['in_progress', 'waiting_to_start', 'cancelled', 'disputed', 'completed'])
                ->whereIn('payment_status', ['paid', 'held'])
                ->orderByDesc('created_at')
                ->get();

            $ongoingJobs = Mission::where('status', 'published')->count();

            // All quote offers made by provider that are NOT accepted yet
            $offers = MissionOffer::where('provider_id', $provider->id)
                ->where('status', 'pending')
                ->with('mission')
                ->orderByDesc('created_at')
                ->get();
        }

        return view('dashboard.provider.jobs.job-list', compact('jobs', 'offers', 'ongoingJobs'));
    }

    public function viewJob(Request $request) 
    {
        $job = Mission::findOrFail($request->id);
        return view('dashboard.provider.jobs.view-job', compact('job'));
    }

    public function quoteOffer(Request $request) 
    {
        $id = $request->query('id') ?? $request->route('id');
        $mission = null;
        $offers = [];
        
        if ($id) {
            $mission = Mission::find($id);
            // Assuming Mission hasMany Offer (or Proposal)
            $offers = $mission ? $mission->offers()->with('provider')->get() : [];
        }

        return view('dashboard.provider.jobs.quote-offer', compact('mission', 'offers'));
    }

    /**
     * Submit an offer for a mission
     * ✅ Uses StoreOfferRequest for validation and authorization
     */
    public function submitOffer(StoreOfferRequest $request, $id)
    {
        // Validation and authorization handled by StoreOfferRequest

        $mission = Mission::findOrFail($id);
        $provider = auth()->user()->serviceProvider;

        // Check if offer already exists for this mission and provider
        $existing = MissionOffer::where('mission_id', $mission->id)
            ->where('provider_id', $provider->id)
            ->first();

        if ($existing) {
            // Update the existing offer
            $existing->update([
                'price' => $request->price,
                'delivery_time' => $request->delivery_time,
                'message' => $request->message,
                'status' => 'pending',
            ]);
            return response()->json(['status' => 'success', 'message' => 'Offer updated successfully!', 'offer' => new MissionOfferResource($existing)]);
        }

        $offer = MissionOffer::create([
            'mission_id' => $mission->id,
            'provider_id' => $provider->id,
            'price' => $request->price,
            'delivery_time' => $request->delivery_time,
            'message' => $request->message,
            'status' => 'pending',
        ]);

        return response()->json(['status' => 'success', 'message' => 'Offer submitted successfully!', 'offer' => new MissionOfferResource($offer)]);
    }

    /**
     * ✅ Annuler une offre (soft delete)
     * Uses MissionOfferPolicy for authorization
     */
    public function cancelOffer(Request $request, $offerId)
    {
        try {
            $offer = MissionOffer::findOrFail($offerId);

            // ✅ Use Policy for authorization
            if (Gate::denies('delete', $offer)) {
                Log::warning('Unauthorized offer cancellation attempt', [
                    'offer_id' => $offerId,
                    'attempting_user' => auth()->id(),
                    'offer_owner' => $offer->provider_id
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'Non autorisé'
                ], 403);
            }

            // Soft delete
            $offer->delete();

            Log::info('Offer cancelled successfully', [
                'offer_id' => $offerId,
                'provider_id' => $offer->provider_id,
                'mission_id' => $offer->mission_id
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Votre offre a été annulée avec succès'
            ]);
            
        } catch (\Exception $e) {
            Log::error('Cancel offer error', [
                'offer_id' => $offerId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue'
            ], 500);
        }
    }

    /**
     * Start a mission
     * ✅ Uses MissionPolicy for authorization
     */
    public function startMission(Request $request)
    {
        $request->validate([
            'mission_id' => 'required|exists:missions,id',
        ]);

        $mission = Mission::findOrFail($request->mission_id);

        // ✅ Use Policy for authorization (checks provider, status, and payment)
        if (Gate::denies('start', $mission)) {
            Log::warning('Unauthorized mission start attempt', [
                'mission_id' => $mission->id,
                'mission_provider' => $mission->selected_provider_id,
                'user_id' => auth()->id()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to start this mission.'
            ], 403);
        }

        if ($mission->status === 'in_progress') {
            return response()->json([
                'success' => false,
                'message' => 'Mission is already in progress.'
            ]);
        }

        // Update mission status
        $mission->status = 'in_progress';
        $mission->save();

        return response()->json([
            'success' => true,
            'message' => 'Mission started successfully!',
            'mission' => new MissionResource($mission)
        ]);
    }

    public function resolveMission(Request $request)
    {
        $request->validate([
            'mission_id' => 'required|exists:missions,id',
        ]);

        $mission = Mission::findOrFail($request->mission_id);

        // SÉCURITÉ: Vérifier que l'utilisateur authentifié est bien le provider de la mission
        $provider = auth()->user()->serviceProvider;
        if (!$provider) {
            return response()->json([
                'success' => false,
                'message' => 'Provider profile not found.'
            ], 403);
        }

        if ($mission->selected_provider_id !== $provider->id) {
            Log::warning('Unauthorized mission resolve attempt', [
                'mission_id' => $mission->id,
                'attempting_provider' => $provider->id,
                'mission_provider' => $mission->selected_provider_id,
                'user_id' => auth()->id()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to resolve this mission.'
            ], 403);
        }

        if ($mission->status !== 'disputed') {
            return response()->json([
                'success' => false,
                'message' => 'Mission is not in dispute status.'
            ], 400);
        }

        $this->refundMissionPayment($mission, $request);

        $this->ReputationPointService->updateReputationPointsBasedOnDisputeResolvedByProvider($provider);

        return response()->json([
            'success' => true,
            'message' => 'Dispute resolved successfully!',
            'mission' => new MissionResource($mission)
        ]);
    }

    private function refundMissionPayment($mission, $request) 
    {
        try {
            Stripe::setApiKey(config('services.stripe.secret'));
            $transaction = $mission->transactions()->where('status', 'paid')->first();
            $paymentIntent = PaymentIntent::retrieve($transaction->stripe_payment_intent_id);
            
            // ✅ Utiliser CurrencyService::toCents pour gérer les devises zero-decimal
            $missionAmount = $paymentIntent->metadata->mission_amount ?? null;
            $currency = $paymentIntent->metadata->currency ?? 'EUR';
            $refundAmountInCents = $missionAmount ? CurrencyService::toCents((float) $missionAmount, $currency) : null;

            if (!$refundAmountInCents) {
                return response()->json(['error' => 'Refund amount not found in metadata'], 400);
            }
            
            $refund = Refund::create([
                'payment_intent' => $paymentIntent->id,
                'amount' => (int) $refundAmountInCents,
            ]);

            if ($refund->status !== 'succeeded') {
                return response()->json(['error' => 'Refund failed'], 500);
            }

            $requester = $mission->requester;

            if ($requester) {
                $requester->increment('credit_balance', $transaction->client_fee);
            }

            $offer = MissionOffer::where('provider_id', $mission->selected_provider_id)
                ->where('mission_id', $mission->id)
                ->first()
                ?->delete();
            
            // Update mission status
            $mission->status = 'cancelled';
            $mission->payment_status = 'refunded';
            $mission->selected_provider_id = null;
            $mission->save();
            $transaction->update(['status' => 'refunded']);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Refund failed: ' . $e->getMessage()
            ], 500);
        }
    }

    public function confirmDelivery(Request $request)
    {
        $request->validate([
            'mission_id' => 'required|exists:missions,id',
        ]);

        $mission = Mission::findOrFail($request->mission_id);

        // SÉCURITÉ: Vérifier que l'utilisateur authentifié est bien le provider de la mission
        $provider = auth()->user()->serviceProvider;
        if (!$provider) {
            return response()->json([
                'success' => false,
                'message' => 'Provider profile not found.'
            ], 403);
        }

        if ($mission->selected_provider_id !== $provider->id) {
            Log::warning('Unauthorized delivery confirmation attempt', [
                'mission_id' => $mission->id,
                'attempting_provider' => $provider->id,
                'mission_provider' => $mission->selected_provider_id,
                'user_id' => auth()->id()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to confirm delivery for this mission.'
            ], 403);
        }

        if ($mission->status !== 'in_progress') {
            return response()->json([
                'success' => false,
                'message' => 'Mission is not in progress.'
            ], 400);
        }

        // Update mission status to completed
        $mission->status = 'completed';
        $mission->save();

        return response()->json([
            'success' => true,
            'message' => 'Delivery confirmed successfully!',
            'mission' => new MissionResource($mission)
        ]);
    }

    public function archive(Request $request, User $user)
    {
        // Optional: block access to other users' archives unless admin
        if ($user->id !== auth()->id() && !optional(auth()->user())->is_admin) {
            abort(403);
        }

        $provider = $user->serviceProvider;

        // If this user doesn't have a provider profile, show empty list
        if (!$provider) {
            $jobs = collect(); // or ->paginate(15) on an empty query if you prefer
            return view('dashboard.archivejobs', compact('jobs'));
        }

        // Completed missions for this provider
        $jobs = Mission::query()
            ->where('selected_provider_id', $provider->id)
            ->where('status', 'completed')
            // if you also want them financially closed, add:
            // ->whereIn('payment_status', ['paid', 'released'])
            // ->with(['customer', 'category']) // eager-load what your view needs
            // ->orderByDesc('completed_at')     // prefer completed_at if you have it
            ->orderByDesc('updated_at')
            ->paginate(15);

        return view('dashboard.archivejobs', compact('jobs'));
    }
}