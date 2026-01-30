<?php

namespace App\Services;

use Stripe\Stripe;
use Stripe\StripeClient;
use App\Models\Transaction;
use App\Models\ServiceProvider;
use App\Models\Country;
use Stripe\PaymentIntent;
use Stripe\Transfer;
use Stripe\Balance;
use App\Models\User;
use App\Models\AffiliateCommission;
use App\Services\CurrencyService;
use App\Services\Gateways\PayPalGateway;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class PaymentService
{
    protected StripeClient $stripe;

    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
        $this->stripe = new StripeClient(config('services.stripe.secret'));
    }

    /**
     * Create a Stripe Connect Custom Account for a service provider.
     * This method centralizes the account creation logic previously duplicated
     * in RegisterController and StripePaymentController.
     *
     * @param ServiceProvider $provider
     * @return array{account_id: string, onboarding_url: ?string, isKYCComplete: bool}
     * @throws \Exception
     */
    public function createConnectAccount(ServiceProvider $provider): array
    {
        try {
            // Get country code
            $countryField = $provider->provider_address ?: $provider->country;
            $country = Country::where('country', $countryField)->first();
            $countryCode = $country?->short_name ?? 'FR';

            // Create account token
            $token = $this->stripe->tokens->create([
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

            // Create the Connect account
            $account = $this->stripe->accounts->create([
                'type' => 'custom',
                'country' => $countryCode,
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

            // Check if onboarding is needed
            if (!$account->details_submitted) {
                $accountLink = $this->stripe->accountLinks->create([
                    'account' => $account->id,
                    'refresh_url' => route('stripe.refresh'),
                    'return_url' => route('stripe.return'),
                    'type' => 'account_onboarding',
                ]);

                Log::info('Stripe Connect account created (pending KYC)', [
                    'provider_id' => $provider->id,
                    'account_id' => $account->id,
                ]);

                return [
                    'account_id' => $account->id,
                    'onboarding_url' => $accountLink->url,
                    'isKYCComplete' => false,
                ];
            }

            Log::info('Stripe Connect account created (KYC complete)', [
                'provider_id' => $provider->id,
                'account_id' => $account->id,
            ]);

            return [
                'account_id' => $account->id,
                'onboarding_url' => null,
                'isKYCComplete' => true,
            ];
        } catch (\Exception $e) {
            Log::error('Stripe Connect account creation failed', [
                'provider_id' => $provider->id,
                'error' => $e->getMessage(),
            ]);
            throw $e;
        }
    }

    /**
     * Update provider with Stripe account info after creation.
     *
     * @param ServiceProvider $provider
     * @param array $stripeAccount
     * @return ServiceProvider
     */
    public function updateProviderStripeInfo(ServiceProvider $provider, array $stripeAccount): ServiceProvider
    {
        $provider->stripe_account_id = $stripeAccount['account_id'];
        $provider->kyc_status = $stripeAccount['isKYCComplete'] ? 'verified' : 'pending';
        $provider->stripe_chg_enabled = $stripeAccount['isKYCComplete'];
        $provider->stripe_pts_enabled = $stripeAccount['isKYCComplete'];
        $provider->kyc_link = $stripeAccount['onboarding_url'] ?? null;
        $provider->save();

        return $provider;
    }

    /**
     * Get or create Stripe Connect account for a provider.
     *
     * @param ServiceProvider $provider
     * @return array
     */
    public function getOrCreateConnectAccount(ServiceProvider $provider): array
    {
        if ($provider->stripe_account_id) {
            return [
                'account_id' => $provider->stripe_account_id,
                'onboarding_url' => $provider->kyc_link,
                'isKYCComplete' => $provider->kyc_status === 'verified',
            ];
        }

        $stripeAccount = $this->createConnectAccount($provider);
        $this->updateProviderStripeInfo($provider, $stripeAccount);

        return $stripeAccount;
    }

    /**
     * Refresh onboarding link for a provider.
     *
     * @param ServiceProvider $provider
     * @return array{completed: bool, url?: string}
     */
    public function refreshOnboardingLink(ServiceProvider $provider): array
    {
        if (!$provider->stripe_account_id) {
            throw new \Exception('Stripe account not found.');
        }

        $account = $this->stripe->accounts->retrieve($provider->stripe_account_id);

        if ($account->details_submitted) {
            $provider->kyc_status = 'verified';
            $provider->stripe_chg_enabled = true;
            $provider->stripe_pts_enabled = true;
            $provider->kyc_link = null;
            $provider->save();

            return ['completed' => true];
        }

        $accountLink = $this->stripe->accountLinks->create([
            'account' => $provider->stripe_account_id,
            'refresh_url' => route('stripe.refresh'),
            'return_url' => route('stripe.return'),
            'type' => 'account_onboarding',
        ]);

        $provider->kyc_link = $accountLink->url;
        $provider->save();

        return ['completed' => false, 'url' => $accountLink->url];
    }

    public function processPayment($amount, $paymentMethod, $customerId, $currency = 'EUR')
    {
        try {
            $paymentIntent = $this->stripe->paymentIntents->create([
                'amount' => CurrencyService::toCents($amount, $currency),
                'currency' => strtolower($currency),
                'payment_method' => $paymentMethod,
                'customer' => $customerId,
                'confirmation_method' => 'manual',
                'confirm' => true,
            ]);

            // Store transaction details in the database
            $transaction = new Transaction();
            $transaction->user_id = $customerId;
            $transaction->amount_paid = $amount;
            $transaction->status = 'completed';
            $transaction->stripe_payment_intent_id = $paymentIntent->id;
            $transaction->save();

            return $transaction;
        } catch (\Exception $e) {
            Log::error('Payment Error: ' . $e->getMessage());
            return null;
        }
    }

    // Method to handle refunds
    public function processRefund($transactionId)
    {
        try {
            $transaction = Transaction::findOrFail($transactionId);
            
            // Refund the payment using Stripe
            $refund = $this->stripe->refunds->create([
                'payment_intent' => $transaction->stripe_payment_intent_id,
            ]);

            // Update the transaction status to refunded
            $transaction->status = 'refunded';
            $transaction->save();

            return $refund;
        } catch (\Exception $e) {
            Log::error('Refund Error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * ✅ Transfère les fonds au prestataire et gère les commissions d'affiliation
     * ✅ SÉCURITÉ: Utilise une transaction DB pour garantir l'atomicité
     */
    public function transferFunds($mission, $provider)
    {
        try {
            // ✅ SÉCURITÉ: Vérifier que le provider a un compte Stripe
            if (!$provider->stripe_account_id) {
                throw new \Exception('Provider does not have a Stripe account configured.');
            }

            // ✅ SÉCURITÉ: Vérifier que la mission est payée
            if ($mission->payment_status !== 'paid') {
                throw new \Exception('Mission payment status must be "paid" before transfer.');
            }

            $commission = \App\Models\UlixCommission::first();
            $transaction = $mission->transactions()->first();

            if (!$transaction || !$transaction->stripe_payment_intent_id) {
                throw new \Exception('No valid transaction found for this mission.');
            }

            // ✅ SÉCURITÉ: Vérifier qu'un transfert n'a pas déjà été effectué (idempotency)
            if ($transaction->stripe_transfer_id) {
                Log::info('Transfer already completed for this transaction', [
                    'transaction_id' => $transaction->id,
                    'transfer_id' => $transaction->stripe_transfer_id,
                ]);
                return ['already_transferred' => true, 'transfer_id' => $transaction->stripe_transfer_id];
            }

            $stripeIntent = PaymentIntent::retrieve($transaction->stripe_payment_intent_id);

            // ✅ SÉCURITÉ: Vérifier que le paiement a bien été reçu
            if ($stripeIntent->amount_received <= 0) {
                throw new \Exception('No payment received for this transaction.');
            }

            // Récupérer la devise depuis la transaction ou utiliser EUR par défaut
            $currency = strtoupper($transaction->currency ?? 'EUR');

            // ✅ Calculer les frais prestataire avec le minimum appliqué
            $amountInCurrency = CurrencyService::fromCents($stripeIntent->amount_received, $currency);
            $calculatedProviderFee = round($amountInCurrency * $commission->provider_fee, 2);
            $minimumServiceFee = CurrencyService::getMinimumServiceFeeStatic($currency);
            $providerFeeAmount = max($calculatedProviderFee, $minimumServiceFee);

            // ✅ CORRECTION: Utiliser round() pour éviter les erreurs de précision
            // Le montant transféré = montant reçu - frais prestataire (avec minimum appliqué)
            $transferAmount = (int) round(CurrencyService::toCents($amountInCurrency - $providerFeeAmount, $currency));

            // ✅ CORRECTION: Formule simplifiée et corrigée pour la commission affilié
            // La commission affilié est basée sur un pourcentage du provider_fee (avec minimum appliqué)
            $affiliateCommissionAmount = round($commission->affiliate_fee * $providerFeeAmount, 2);

            // Devise en minuscules pour Stripe
            $currencyLower = strtolower($currency);

            // ✅ SÉCURITÉ: Transaction DB pour garantir l'atomicité
            return DB::transaction(function () use ($mission, $provider, $transferAmount, $affiliateCommissionAmount, $transaction, $currency, $currencyLower) {
                // 1. Créer le transfert Stripe vers le prestataire
                $transfer = Transfer::create([
                    'amount' => $transferAmount,
                    'currency' => $currencyLower,
                    'destination' => $provider->stripe_account_id,
                    'transfer_group' => 'MISSION_' . $mission->id,
                    'metadata' => [
                        'mission_id' => $mission->id,
                        'provider_id' => $provider->id,
                        'transaction_id' => $transaction->id,
                    ],
                ]);

                // ✅ SÉCURITÉ: Enregistrer l'ID du transfert pour éviter les doublons
                $transaction->update(['stripe_transfer_id' => $transfer->id]);

                // 2. Gérer la commission d'affiliation si applicable
                $referee = auth()->user() ?? User::find($mission->requester_id);

                if ($referee && $referee->referred_by) {
                    $referrer = User::find($referee->referred_by);

                    if ($referrer && $affiliateCommissionAmount > 0) {
                        // ✅ CORRECTION: Status 'available' (prêt pour retrait), pas 'paid'
                        // Le status 'paid' sera mis lors du payout réel
                        AffiliateCommission::create([
                            'referrer_id' => $referrer->id,
                            'referee_id' => $referee->id,
                            'mission_id' => $mission->id,
                            'amount' => $affiliateCommissionAmount,
                            'currency' => strtoupper($currency), // ✅ Devise de la transaction
                            'status' => 'available', // ✅ CORRECTION: Disponible pour retrait
                            'payout_method' => 'stripe',
                            'stripe_transfer_id' => $transfer->id,
                        ]);

                        // ✅ Mettre à jour les balances du parrain
                        $referrer->increment('affiliate_balance', $affiliateCommissionAmount);
                        $referrer->increment('pending_affiliate_balance', $affiliateCommissionAmount);

                        Log::info('✅ Affiliate commission created', [
                            'referrer_id' => $referrer->id,
                            'referee_id' => $referee->id,
                            'mission_id' => $mission->id,
                            'amount' => $affiliateCommissionAmount,
                        ]);
                    }
                }

                Log::info('✅ Transfer completed successfully', [
                    'mission_id' => $mission->id,
                    'provider_id' => $provider->id,
                    'transfer_amount' => $transferAmount / 100, // En euros
                    'transfer_id' => $transfer->id,
                ]);

                return $transfer;
            }, 5); // 5 tentatives en cas de deadlock

        } catch (\Exception $e) {
            Log::error('❌ Transfer Error: ' . $e->getMessage(), [
                'mission_id' => $mission->id ?? null,
                'provider_id' => $provider->id ?? null,
                'trace' => $e->getTraceAsString(),
            ]);
            return ['message' => $e->getMessage(), 'error' => true];
        }
    }

    public function providerAccountBalance($provider) {
        try {
            $balance = Balance::retrieve( [
                'stripe_account' => $provider->stripe_account_id
            ] ,[]);

            $currency = strtoupper($balance->available[0]->currency ?? 'EUR');
            return [
                'available' => CurrencyService::fromCents($balance->available[0]->amount, $currency),
                'pending' => CurrencyService::fromCents($balance->pending[0]->amount, $currency),
                'currency' => $currency
            ];
            
        } catch (\Exception $e) {
            \Log::error('Stripe balance fetch failed: ' . $e->getMessage());
            return ['error' => $e->getMessage()];
        }
    }

    public function ulixaiPlatformBalance() {
        try {
            $balance = \Stripe\Balance::retrieve();

            $currency = strtoupper($balance->available[0]->currency ?? 'EUR');
            return [
                'available' => CurrencyService::fromCents($balance->available[0]->amount, $currency),
                'pending' => CurrencyService::fromCents($balance->pending[0]->amount, $currency),
                'currency' => $currency
            ];

        } catch (\Exception $e) {
            \Log::error('Stripe platform balance fetch failed: ' . $e->getMessage());
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * Rembourse une transaction.
     * Supporte Stripe et PayPal.
     *
     * @param Transaction $transaction
     * @param float|null $amount Montant partiel (null = remboursement total)
     * @return array{success: bool, refund_id: string, gateway: string}
     * @throws \Exception
     */
    public function refundTransaction($transaction, ?float $amount = null): array
    {
        try {
            // ✅ Brancher selon la passerelle de paiement
            if ($transaction->is_paypal) {
                return $this->refundPayPalTransaction($transaction, $amount);
            } else {
                return $this->refundStripeTransaction($transaction, $amount);
            }
        } catch (\Exception $e) {
            Log::error('Refund failed', [
                'transaction_id' => $transaction->id,
                'gateway' => $transaction->payment_gateway,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    /**
     * Remboursement Stripe.
     */
    private function refundStripeTransaction(Transaction $transaction, ?float $amount = null): array
    {
        if (!$transaction->stripe_payment_intent_id) {
            throw new \Exception('No Stripe payment intent found');
        }

        $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

        // Get the payment intent to find the charge ID
        $paymentIntent = $stripe->paymentIntents->retrieve($transaction->stripe_payment_intent_id);

        if (!$paymentIntent->latest_charge) {
            throw new \Exception('No charge found for this payment');
        }

        // Préparer les paramètres du remboursement
        $refundParams = [
            'charge' => $paymentIntent->latest_charge,
            'metadata' => [
                'transaction_id' => $transaction->id,
                'refunded_by' => 'admin',
                'mission_id' => $transaction->mission_id
            ]
        ];

        // Remboursement partiel si montant spécifié
        if ($amount !== null) {
            $currency = $transaction->currency ?? 'EUR';
            $refundParams['amount'] = CurrencyService::toCents($amount, $currency);
        }

        // Create the refund
        $refund = $stripe->refunds->create($refundParams);

        Log::info('Stripe transaction refunded', [
            'transaction_id' => $transaction->id,
            'refund_id' => $refund->id,
            'amount' => $refund->amount,
            'status' => $refund->status,
        ]);

        return [
            'success' => $refund->status === 'succeeded',
            'refund_id' => $refund->id,
            'gateway' => 'stripe',
            'amount' => CurrencyService::fromCents($refund->amount, $transaction->currency ?? 'EUR'),
        ];
    }

    /**
     * Remboursement PayPal.
     */
    private function refundPayPalTransaction(Transaction $transaction, ?float $amount = null): array
    {
        if (!$transaction->paypal_capture_id) {
            throw new \Exception('No PayPal capture ID found');
        }

        $paypalGateway = app(PayPalGateway::class);
        $currency = $transaction->currency ?? 'EUR';

        // Si pas de montant spécifié, rembourser le montant total
        $refundAmount = $amount ?? (float) $transaction->amount_paid;

        $result = $paypalGateway->refund(
            $transaction->paypal_capture_id,
            $refundAmount,
            $currency
        );

        Log::info('PayPal transaction refunded', [
            'transaction_id' => $transaction->id,
            'refund_id' => $result['refund_id'],
            'amount' => $result['amount'],
            'status' => $result['status'],
        ]);

        return [
            'success' => $result['status'] === 'COMPLETED',
            'refund_id' => $result['refund_id'],
            'gateway' => 'paypal',
            'amount' => $result['amount'],
        ];
    }
}
