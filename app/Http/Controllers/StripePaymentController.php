<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mission;
use App\Models\User;
use App\Models\MissionOffer;
use App\Models\ServiceProvider;
use App\Models\Transaction;
use App\Models\AffiliateCommission;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\PaymentIntent;
use Stripe\Transfer;
use Stripe\Account;
use Stripe\AccountLink;
use Stripe\Account as StripeAccount;
use Illuminate\Support\Facades\DB;
use App\Models\UlixCommission;
use App\Models\Country;

class StripePaymentController extends Controller
{
    
    public function checkout(Request $request)
    {
        $mission = Mission::findOrFail($request->mission_id);
        $provider = ServiceProvider::findOrFail($request->provider_id);
        $offer = MissionOffer::findOrFail($request->offer_id);

        if (!$provider->stripe_account_id) {

            $stripeAccount = $this->createStripeConnectCustomAccount($provider);
            
            $provider->stripe_account_id = $stripeAccount['account_id'];
            $provider->kyc_status = $stripeAccount['isKYCCompele'] ? 'verified' : 'pending';
            $provider->stripe_chg_enabled = $stripeAccount['isKYCCompele'] ? true : false;
            $provider->stripe_pts_enabled = $stripeAccount['isKYCCompele'] ? true : false;
            $provider->kyc_link = $stripeAccount['onboarding_url'] ?? null;
            $provider->save();
        }
        
        // Calculate fees
        $amount = (float) $request->amount;
        $clientFee = (float) $request->client_fee;
        $total = (float) $request->total;
        $remainingCreditBalance = (float) $request->remaining_credits;
        
        Stripe::setApiKey(config('services.stripe.secret'));

        $platformFeeInCents = intval($clientFee * 100);
        $totalInCents = intval($total * 100);

        $paymentIntent = PaymentIntent::create([
            'amount' => $totalInCents, 
            'currency' => 'eur',
            'payment_method_types' => ['card'],
            'metadata' => [
                'mission_id' => $mission->id,
                'provider_id' => $provider->id,
                'offer_id' => $offer->id,
                'client_fee' => $clientFee,
                'mission_amount' => $amount,
                'remaining_credits' => $remainingCreditBalance,
            ],
        ]);

        // ✅ CORRECTION : Ne plus modifier la mission ICI
        // On attend la confirmation du paiement dans processPayment()
        // L'annonce reste visible jusqu'au paiement effectif

        return view('dashboard.pay-card', [
            'mission' => $mission,
            'provider' => $provider,
            'offer' => $offer,
            'amount' => $amount,
            'clientFee' => $clientFee,
            'total' => $total,
            'clientSecret' => $paymentIntent->client_secret,
        ]);
    }


    public function processPayment(Request $request)
    {
        $request->validate([
            'payment_intent_id' => 'required|string',
        ]);
        $commission = UlixCommission::first();
        Stripe::setApiKey(config('services.stripe.secret'));
        
        try {
            // Retrieve the payment intent
            $paymentIntent = PaymentIntent::retrieve($request->payment_intent_id);
            
            if ($paymentIntent->status === 'succeeded') {
                $missionId = $paymentIntent->metadata['mission_id'];
                $providerId = $paymentIntent->metadata['provider_id'];
                $offerId = $paymentIntent->metadata['offer_id'];
                $clientFee = $paymentIntent->metadata['client_fee'];
                $remainingCredits = $paymentIntent->metadata['remaining_credits'];
                $missionAmount = $paymentIntent->metadata['mission_amount'];
                
                // ✅ Vérifier si déjà traité (évite les doublons)
                $existingTransaction = Transaction::where('stripe_payment_intent_id', $paymentIntent->id)->first();
                if ($existingTransaction) {
                    return response()->json([
                        'success' => true,
                        'redirect_url' => route('payments.success', ['mission' => $missionId, 'credits' => $remainingCredits])
                    ]);
                }

                // ✅ CORRECTION : Maintenant on modifie la mission APRÈS le paiement réussi
                $mission = Mission::find($missionId);
                $mission->status = 'waiting_to_start';
                $mission->payment_status = 'paid';
                $mission->selected_provider_id = $providerId; // ✅ AJOUTÉ - Crucial !
                $mission->save();

                // ✅ Accepter l'offre
                $missionOffer = MissionOffer::find($offerId);
                $missionOffer->status = 'accepted'; 
                $missionOffer->save();

                // ✅ Enregistrer la transaction
                Transaction::create([
                    'mission_id' => $missionId,
                    'provider_id' => $providerId,
                    'offer_id' => $offerId,
                    'stripe_payment_intent_id' => $paymentIntent->id,
                    'amount_paid' => $paymentIntent->amount / 100,
                    'client_fee' => $clientFee,
                    'provider_fee' => ($paymentIntent->amount / 100) * $commission->provider_fee,
                    'country' => $mission->location_country,
                    'user_role' => auth()->user()->user_role,
                    'status' => 'paid',
                ]);
                
                return response()->json([
                    'success' => true,
                    'redirect_url' => route('payments.success', ['mission' => $mission->id, 'credits' => $remainingCredits])
                ]);
            }

            return response()->json([
                'success' => false,
                'error' => 'Payment not completed'
            ], 400);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function success(Mission $mission, $credits)
    {
        
        $provider = $mission->selectedProvider;
        if (!$provider) {
            return redirect()->route('dashboard')->with('error', 'No provider selected for this mission.');
        }
        $reviews = $provider->reviews()->get() ?? [];

        $requester = $mission->requester;

        if($requester) {
            $requester->update(['credit_balance' => $credits]);
        }
        
        return view('dashboard.order-confirm', compact('mission', 'provider', 'reviews'));
    }

    public function cancel()
    {
        return view('dashboard.payments-cancel');
    }

    private function createStripeConnectCustomAccount(ServiceProvider $provider)
    {
        Stripe::setApiKey(config('services.stripe.secret'));
        $country = Country::where('country', $provider->country)->first();
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
        $token = $stripe->tokens->create([
            'account' => [
                'business_type' => 'individual',
                'individual' => [
                    'first_name' => $provider->first_name,
                    'last_name' => $provider->last_name,
                    'email' => $provider->email,
                ],
                'tos_shown_and_accepted' => true,
            ],
        ]);
        $account = $stripe->accounts->create([
            'type' => 'custom',
            'country' => $country ? $country->short_name : 'FR',
            'email' => $provider->email,
            'account_token' => $token->id,
            'capabilities' => [
                'card_payments' => ['requested' => true],
                'transfers' => ['requested' => true],
            ],
            'business_profile' => [
                'product_description' => 'Ulixai Service Provider',
            ],
        ]);

        if (!$account->details_submitted) {
           
            $accountLink = $stripe->accountLinks->create([
                'account' => $account->id,
                'refresh_url' => route('stripe.refresh'), 
                'return_url' => route('stripe.return'),
                'type' => 'account_onboarding',
            ]);
            return [
                'account_id' => $account->id,
                'onboarding_url' => $accountLink->url,
                'isKYCCompele' => false
            ];
        }

        return [
            'account_id' => $account->id,
            'onboarding_url' => null,
            'isKYCCompele' => true
        ];
    }

    public function getOnboardingLink(Request $request)
    {
        $provider = auth()->user()->serviceProvider;
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

        if (!$provider->stripe_account_id) {
            return response()->json(['error' => 'Stripe account not found.'], 404);
        }

        $account = $stripe->accounts->retrieve($provider->stripe_account_id);

        if ($account->details_submitted) {
            $provider->kyc_status = 'verified';
            $provider->stripe_chg_enabled = true;
            $provider->stripe_pts_enabled = true;
            $provider->kyc_link = null;
            $provider->save();
            return response()->json(['completed' => true]);
        }

        $accountLink = $stripe->accountLinks->create([
            'account' => $provider->stripe_account_id,
            'refresh_url' => route('stripe.refresh'),
            'return_url' => route('stripe.return'),
            'type' => 'account_onboarding',
        ]);

        return response()->json(['completed' => false, 'url' => $accountLink->url]);
    }
}