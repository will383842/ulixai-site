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
use App\Services\PaymentService;
use App\Services\CurrencyService;
use App\Http\Requests\Payment\CheckoutRequest;
use App\Http\Requests\Payment\ProcessPaymentRequest;

class StripePaymentController extends Controller
{
    protected PaymentService $paymentService;
    protected CurrencyService $currencyService;

    public function __construct(PaymentService $paymentService, CurrencyService $currencyService)
    {
        $this->paymentService = $paymentService;
        $this->currencyService = $currencyService;
    }

    public function checkout(CheckoutRequest $request)
    {
        $mission = Mission::findOrFail($request->mission_id);
        $provider = ServiceProvider::findOrFail($request->provider_id);
        $offer = MissionOffer::findOrFail($request->offer_id);

        // ✅ SÉCURITÉ: Vérifier que l'utilisateur est propriétaire de la mission
        if ($mission->requester_id !== auth()->id()) {
            abort(403, 'You are not authorized to pay for this mission.');
        }

        // ✅ SÉCURITÉ: Vérifier que la mission n'est pas déjà payée
        if ($mission->payment_status === 'paid') {
            return redirect()->route('dashboard')->with('error', 'This mission is already paid.');
        }

        // ✅ SÉCURITÉ: Vérifier que l'offre appartient bien à cette mission et ce provider
        if ($offer->mission_id !== $mission->id || $offer->provider_id !== $provider->id) {
            abort(422, 'Invalid offer for this mission.');
        }

        // ✅ SÉCURITÉ: Vérifier que l'offre est toujours en attente
        if ($offer->status !== 'pending') {
            return redirect()->route('dashboard')->with('error', 'This offer is no longer available.');
        }

        if (!$provider->stripe_account_id) {
            $stripeAccount = $this->paymentService->createConnectAccount($provider);
            $this->paymentService->updateProviderStripeInfo($provider, $stripeAccount);
        }

        // Calculate fees
        $amount = (float) $request->amount;
        $clientFee = (float) $request->client_fee;
        $total = (float) $request->total;
        $remainingCreditBalance = (float) $request->remaining_credits;

        // ✅ SÉCURITÉ: Valider que le calcul est correct (tolérance de 1 centime)
        $expectedTotal = $amount + $clientFee;
        if (abs($total - $expectedTotal) > 0.01) {
            abort(422, 'Invalid payment amount calculation.');
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        // ✅ Récupérer et valider la devise depuis la mission
        $currency = strtoupper($mission->budget_currency ?? 'EUR');
        $supportedCurrencies = $this->currencyService->getSupportedCurrencies();
        if (!in_array($currency, $supportedCurrencies)) {
            $currency = 'EUR'; // Fallback vers EUR si devise non supportée
        }

        // ✅ CORRECTION: Utiliser CurrencyService pour la conversion en centimes
        $platformFeeInCents = CurrencyService::toCents($clientFee, $currency);
        $totalInCents = CurrencyService::toCents($total, $currency);

        $paymentIntent = PaymentIntent::create([
            'amount' => $totalInCents,
            'currency' => strtolower($currency),
            'payment_method_types' => ['card'],
            'metadata' => [
                'mission_id' => $mission->id,
                'provider_id' => $provider->id,
                'offer_id' => $offer->id,
                'client_fee' => $clientFee,
                'mission_amount' => $amount,
                'remaining_credits' => $remainingCreditBalance,
                'currency' => $currency,
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
            'currency' => $currency,
        ]);
    }


    public function processPayment(ProcessPaymentRequest $request)
    {
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
                $currency = $paymentIntent->metadata['currency'] ?? 'EUR';

                // ✅ Valider la devise (EUR ou USD uniquement)
                $supportedCurrencies = $this->currencyService->getSupportedCurrencies();
                if (!in_array(strtoupper($currency), $supportedCurrencies)) {
                    $currency = 'EUR';
                }

                // ✅ Récupérer la mission d'abord pour les vérifications
                $mission = Mission::find($missionId);
                if (!$mission) {
                    return response()->json([
                        'success' => false,
                        'error' => 'Mission not found.'
                    ], 404);
                }

                // ✅ SÉCURITÉ: Vérifier l'autorisation AVANT toute modification
                if ($mission->requester_id !== auth()->id()) {
                    return response()->json([
                        'success' => false,
                        'error' => 'Unauthorized: You are not the owner of this mission.'
                    ], 403);
                }

                // ✅ SÉCURITÉ: Vérifier que la mission n'est pas déjà payée
                if ($mission->payment_status === 'paid') {
                    return response()->json([
                        'success' => true,
                        'redirect_url' => route('payments.success', ['mission' => $missionId])
                    ]);
                }

                // ✅ Vérifier si déjà traité (évite les doublons)
                $existingTransaction = Transaction::where('stripe_payment_intent_id', $paymentIntent->id)->first();
                if ($existingTransaction) {
                    return response()->json([
                        'success' => true,
                        'redirect_url' => route('payments.success', ['mission' => $missionId])
                    ]);
                }

                // ✅ SÉCURITÉ: Transaction DB pour atomicité
                DB::transaction(function () use ($mission, $missionId, $providerId, $offerId, $clientFee, $paymentIntent, $commission, $remainingCredits, $currency) {
                    // Modifier la mission APRÈS validation
                    $mission->status = 'waiting_to_start';
                    $mission->payment_status = 'paid';
                    $mission->selected_provider_id = $providerId;
                    $mission->save();

                    // Accepter l'offre
                    $missionOffer = MissionOffer::find($offerId);
                    if ($missionOffer) {
                        $missionOffer->status = 'accepted';
                        $missionOffer->save();
                    }

                    // Enregistrer la transaction
                    $amountPaid = CurrencyService::fromCents($paymentIntent->amount, $currency);

                    // ✅ Calculer les frais prestataire avec le minimum appliqué
                    $calculatedProviderFee = round($amountPaid * $commission->provider_fee, 2);
                    $minimumServiceFee = $this->currencyService->getMinimumServiceFee($currency);
                    $providerFee = max($calculatedProviderFee, $minimumServiceFee);

                    Transaction::create([
                        'mission_id' => $missionId,
                        'provider_id' => $providerId,
                        'offer_id' => $offerId,
                        'stripe_payment_intent_id' => $paymentIntent->id,
                        'amount_paid' => round($amountPaid, 2),
                        'client_fee' => round((float) $clientFee, 2),
                        'provider_fee' => $providerFee,
                        'country' => $mission->location_country,
                        'user_role' => auth()->user()->user_role,
                        'status' => 'paid',
                        'currency' => $currency,
                    ]);

                    // ✅ SÉCURITÉ: Mettre à jour le solde de crédits depuis la DB, pas depuis l'URL
                    $requester = $mission->requester;
                    if ($requester && $remainingCredits !== null) {
                        // Recalculer le solde réel plutôt que de faire confiance à la valeur du client
                        $usedCredits = $requester->credit_balance - (float) $remainingCredits;
                        if ($usedCredits > 0 && $usedCredits <= $requester->credit_balance) {
                            $requester->decrement('credit_balance', $usedCredits);
                        }
                    }
                }, 5);

                return response()->json([
                    'success' => true,
                    'redirect_url' => route('payments.success', ['mission' => $mission->id])
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

    public function success(Mission $mission)
    {
        // ✅ SÉCURITÉ: Vérifier que l'utilisateur est propriétaire de la mission
        if ($mission->requester_id !== auth()->id()) {
            abort(403, 'Unauthorized access.');
        }

        $provider = $mission->selectedProvider;
        if (!$provider) {
            return redirect()->route('dashboard')->with('error', 'No provider selected for this mission.');
        }
        $reviews = $provider->reviews()->get() ?? [];

        // ✅ SÉCURITÉ: Ne plus modifier credit_balance ici
        // Le solde est mis à jour de manière sécurisée dans processPayment()

        return view('dashboard.order-confirm', compact('mission', 'provider', 'reviews'));
    }

    public function cancel()
    {
        return view('dashboard.payments-cancel');
    }

    public function getOnboardingLink(Request $request)
    {
        $provider = auth()->user()->serviceProvider;

        if (!$provider->stripe_account_id) {
            return response()->json(['error' => 'Stripe account not found.'], 404);
        }

        try {
            $result = $this->paymentService->refreshOnboardingLink($provider);
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}