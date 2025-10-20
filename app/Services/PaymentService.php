<?php

namespace App\Services;
use Stripe\Stripe;
use Stripe\StripeClient;
use App\Models\Transaction;
use Stripe\PaymentIntent;
use Stripe\Transfer;
use Stripe\Balance;
use App\Models\User;
use App\Models\AffiliateCommission;
use Illuminate\Support\Facades\Log;

class PaymentService
{
    protected $stripe;

    public function __construct()
    {
        $this->stripe = Stripe::setApiKey(config('services.stripe.secret'));
        $this->stripe = new StripeClient(config('services.stripe.secret'));
    }

    public function processPayment($amount, $currency, $paymentMethod, $customerId)
    {
        try {
            $paymentIntent = $this->stripe->paymentIntents->create([
                'amount' => $amount * 100,
                'currency' => $currency,
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

    // Method to handle fund transfer
    public function transferFunds($mission, $provider)
    {
        try {
            $commission = \App\Models\UlixCommission::first();
            $stripeIntent = PaymentIntent::retrieve($mission->transactions()->first()->stripe_payment_intent_id);
            
            $transferAmount = floor($stripeIntent->amount_received - ($stripeIntent->amount_received * $commission->provider_fee));
            $transaction = $mission->transactions()->first();

            $commissionAmount = ($commission->affiliate_fee * $transaction->provider_fee)* 100 / 100;
            $transfer = Transfer::create([
                'amount' => $transferAmount, 
                'currency' => 'eur',
                'destination' => $provider->stripe_account_id,
                'transfer_group' => 'MISSION_'.$mission->id,
            ]);

            $referee = auth()->user() ?? User::find($mission->requester_id);

            if( $referee->referred_by) {
                $referrer = User::find($referee->referred_by);

                if ($referrer) {
                    $commissionData = [
                        'referrer_id' => $referrer->id,
                        'referee_id' => $referee->id,
                        'mission_id' => $mission->id,
                        'amount' => $commissionAmount,
                        'status' => 'available',
                    ];
                    $commissionData['status'] = 'paid';
                    $commissionData['payout_method'] = 'stripe';
                    $commissionData['stripe_transfer_id'] = null;
                    AffiliateCommission::create($commissionData);
                    $referrer->increment('affiliate_balance', $commissionAmount);
                    $referrer->increment('pending_affiliate_balance', $commissionAmount);
                }
            }
            return $transfer;
        } catch (\Exception $e) {
            Log::error('Transfer Error: ' . $e->getMessage());
            return ['message' => $e->getMessage()];
        }
    }

    public function providerAccountBalance($provider) {
        try {
            $balance = Balance::retrieve( [
                'stripe_account' => $provider->stripe_account_id
            ] ,[]);

            return [
                'available' => $balance->available[0]->amount / 100,
                'pending' => $balance->pending[0]->amount / 100,
                'currency' => strtoupper($balance->available[0]->currency)
            ];
            
        } catch (\Exception $e) {
            \Log::error('Stripe balance fetch failed: ' . $e->getMessage());
            return ['error' => $e->getMessage()];
        }
    }

    public function ulixaiPlatformBalance() {
        try {
            $balance = \Stripe\Balance::retrieve();

            return [
                'available' => $balance->available[0]->amount / 100,
                'pending' => $balance->pending[0]->amount / 100,
                'currency' => strtoupper($balance->available[0]->currency)
            ];

        } catch (\Exception $e) {
            \Log::error('Stripe platform balance fetch failed: ' . $e->getMessage());
            return ['error' => $e->getMessage()];
        }
    }

    public function refundTransaction($transaction)
    {
        try {
            if (!$transaction->stripe_payment_intent_id) {
                throw new \Exception('No Stripe payment intent found');
            }

            $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
            
            // Get the payment intent to find the charge ID
            $paymentIntent = $stripe->paymentIntents->retrieve($transaction->stripe_payment_intent_id);
            
            if (!$paymentIntent->latest_charge) {
                throw new \Exception('No charge found for this payment');
            }

            // Create the refund
            $refund = $stripe->refunds->create([
                'charge' => $paymentIntent->latest_charge,
                'metadata' => [
                    'transaction_id' => $transaction->id,
                    'refunded_by' => 'admin',
                    'mission_id' => $transaction->mission_id
                ]
            ]);

            // Log the refund
            \Log::info('Transaction refunded', [
                'transaction_id' => $transaction->id,
                'refund_id' => $refund->id,
                'amount' => $refund->amount
            ]);

            return true;
        } catch (\Exception $e) {
            \Log::error('Refund failed', [
                'transaction_id' => $transaction->id,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }
}
