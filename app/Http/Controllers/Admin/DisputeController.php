<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AffiliateCommission;
use App\Models\Mission;
use App\Models\Transaction;
use App\Models\User;
use App\Services\AuditLogService;
use App\Services\CurrencyService;
use App\Services\Gateways\PayPalGateway;
use App\Services\NotificationService;
use App\Notifications\DisputeResolvedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Refund;
use Stripe\Stripe;
use Stripe\Transfer;

/**
 * Contrôleur pour la gestion des litiges admin.
 *
 * Supporte les remboursements et transferts pour Stripe ET PayPal.
 */
class DisputeController extends Controller
{
    private PayPalGateway $paypalGateway;

    public function __construct(PayPalGateway $paypalGateway)
    {
        $this->paypalGateway = $paypalGateway;
    }

    public function index()
    {
        $disputes = Mission::with(['requester', 'selectedProvider.user', 'transactions', 'cancellationReasons'])
            ->where('status', 'disputed')
            ->where('payment_status', 'held')
            ->whereNotNull('selected_provider_id')
            ->get();

        return view('admin.dashboard.mission-disputes.disputes', compact('disputes'));
    }

    /**
     * Rembourse le paiement au requester.
     * Supporte Stripe et PayPal.
     */
    public function refund(Request $request)
    {
        $mission = Mission::findOrFail($request->mission_id);
        $transaction = $mission->transactions()->where('status', 'paid')->firstOrFail();
        $requester = $mission->requester;

        $refundAmount = $transaction->amount_paid - $transaction->client_fee;
        $currency = $transaction->currency ?? 'EUR';

        try {
            // ✅ Brancher selon la passerelle de paiement
            if ($transaction->is_paypal) {
                $result = $this->refundPayPal($transaction, $refundAmount, $currency);
            } else {
                $result = $this->refundStripe($transaction, $refundAmount, $currency);
            }

            if ($result['success']) {
                $transaction->update([
                    'status' => 'refunded',
                    'released_at' => now(),
                ]);

                $mission->update([
                    'status' => 'cancelled',
                    'payment_status' => 'refunded',
                ]);

                $requester->increment('credit_balance', $transaction->client_fee);

                // Log critique pour traçabilité
                AuditLogService::logRefund($transaction, 'dispute_refund_to_requester');

                // Notifications aux deux parties
                NotificationService::send(
                    $requester,
                    new DisputeResolvedNotification($mission, 'refunded', $refundAmount),
                    NotificationService::TYPE_DISPUTE
                );

                if ($provider = $mission->selectedProvider) {
                    NotificationService::send(
                        $provider->user,
                        new DisputeResolvedNotification($mission, 'refunded', $refundAmount),
                        NotificationService::TYPE_DISPUTE
                    );
                }

                Log::info('Dispute refund successful', [
                    'mission_id' => $mission->id,
                    'transaction_id' => $transaction->id,
                    'gateway' => $transaction->payment_gateway,
                    'amount' => $refundAmount,
                ]);

                return response()->json([
                    'message' => 'Payment successfully refunded to requester',
                    'gateway' => $transaction->payment_gateway,
                ]);
            }

            return response()->json(['message' => 'Refund failed: ' . ($result['error'] ?? 'Unknown error')], 400);

        } catch (\Exception $e) {
            Log::error('Dispute refund failed', [
                'mission_id' => $mission->id,
                'error' => $e->getMessage(),
            ]);
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Transfère le paiement au provider.
     * Supporte Stripe et PayPal.
     */
    public function transfer(Request $request)
    {
        $mission = Mission::findOrFail($request->mission_id);
        $transaction = $mission->transactions()->where('status', 'paid')->firstOrFail();
        $commission = \App\Models\UlixCommission::first();
        if (!$commission) {
            return response()->json(['message' => 'Commission configuration not found. Please configure platform fees in admin.'], 500);
        }
        $provider = $mission->selectedProvider;

        $commissionAmount = ($commission->affiliate_fee * $transaction->provider_fee);
        $payProvider = ($transaction->amount_paid - $transaction->provider_fee) - $transaction->client_fee;
        $currency = $transaction->currency ?? 'EUR';

        try {
            // ✅ Brancher selon la passerelle de paiement
            if ($transaction->is_paypal) {
                $result = $this->transferPayPal($transaction, $provider, $payProvider, $currency, $mission);
            } else {
                $result = $this->transferStripe($transaction, $provider, $payProvider, $currency, $mission);
            }

            if ($result['success']) {
                // Gestion des commissions affiliées
                $referee = auth()->user() ?? User::find($mission->requester_id);

                if ($referee && $referee->referred_by) {
                    $referrer = User::find($referee->referred_by);

                    if ($referrer) {
                        $commissionData = [
                            'referrer_id' => $referrer->id,
                            'referee_id' => $referee->id,
                            'mission_id' => $mission->id,
                            'amount' => $commissionAmount,
                            'currency' => strtoupper($currency),
                            'status' => 'paid',
                            'payout_method' => $transaction->payment_gateway,
                            'stripe_transfer_id' => $result['transfer_id'] ?? null,
                        ];
                        AffiliateCommission::create($commissionData);
                        $referrer->increment('affiliate_balance', $commissionAmount);
                        $referrer->increment('pending_affiliate_balance', $commissionAmount);
                    }
                }

                $transaction->update([
                    'status' => 'released',
                    'released_at' => now(),
                ]);

                $mission->update([
                    'status' => 'completed',
                    'payment_status' => 'released',
                ]);

                // Log critique pour traçabilité
                AuditLogService::logPayment($transaction, 'dispute_transfer_to_provider');

                // Notifications aux deux parties
                NotificationService::send(
                    $mission->requester,
                    new DisputeResolvedNotification($mission, 'transferred', $payProvider),
                    NotificationService::TYPE_DISPUTE
                );

                NotificationService::send(
                    $provider->user,
                    new DisputeResolvedNotification($mission, 'transferred', $payProvider),
                    NotificationService::TYPE_DISPUTE
                );

                Log::info('Dispute transfer successful', [
                    'mission_id' => $mission->id,
                    'transaction_id' => $transaction->id,
                    'gateway' => $transaction->payment_gateway,
                    'amount' => $payProvider,
                ]);

                return response()->json([
                    'message' => 'Payment successfully transferred to provider',
                    'gateway' => $transaction->payment_gateway,
                ]);
            }

            return response()->json(['message' => 'Transfer failed: ' . ($result['error'] ?? 'Unknown error')], 400);

        } catch (\Exception $e) {
            Log::error('Dispute transfer failed', [
                'mission_id' => $mission->id,
                'error' => $e->getMessage(),
            ]);
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    // =========================================================================
    // MÉTHODES PRIVÉES - STRIPE
    // =========================================================================

    private function refundStripe(Transaction $transaction, float $amount, string $currency): array
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        if (!$transaction->stripe_payment_intent_id) {
            return ['success' => false, 'error' => 'No Stripe payment intent found'];
        }

        $refund = Refund::create([
            'payment_intent' => $transaction->stripe_payment_intent_id,
            'amount' => CurrencyService::toCents($amount, $currency),
        ]);

        return [
            'success' => $refund->status === 'succeeded',
            'refund_id' => $refund->id,
            'error' => $refund->status !== 'succeeded' ? 'Refund status: ' . $refund->status : null,
        ];
    }

    private function transferStripe(Transaction $transaction, $provider, float $amount, string $currency, Mission $mission): array
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        if (!$provider->stripe_account_id) {
            return ['success' => false, 'error' => 'Provider has no Stripe account'];
        }

        $transfer = Transfer::create([
            'amount' => CurrencyService::toCents($amount, $currency),
            'currency' => strtolower($currency),
            'destination' => $provider->stripe_account_id,
            'transfer_group' => 'MISSION_' . $mission->id,
        ]);

        // Mettre à jour la transaction avec l'ID de transfert
        $transaction->update(['stripe_transfer_id' => $transfer->id]);

        return [
            'success' => true,
            'transfer_id' => $transfer->id,
        ];
    }

    // =========================================================================
    // MÉTHODES PRIVÉES - PAYPAL
    // =========================================================================

    private function refundPayPal(Transaction $transaction, float $amount, string $currency): array
    {
        if (!$transaction->paypal_capture_id) {
            return ['success' => false, 'error' => 'No PayPal capture ID found'];
        }

        try {
            $result = $this->paypalGateway->refund(
                $transaction->paypal_capture_id,
                $amount,
                $currency
            );

            return [
                'success' => $result['status'] === 'COMPLETED',
                'refund_id' => $result['refund_id'],
                'error' => $result['status'] !== 'COMPLETED' ? 'Refund status: ' . $result['status'] : null,
            ];

        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    private function transferPayPal(Transaction $transaction, $provider, float $amount, string $currency, Mission $mission): array
    {
        try {
            $result = $this->paypalGateway->sendPayout(
                $provider,
                $amount,
                $currency,
                "Dispute resolution payment for mission: {$mission->title}",
                [
                    'mission_id' => $mission->id,
                    'transaction_id' => $transaction->id,
                    'type' => 'dispute_resolution',
                ]
            );

            // Mettre à jour la transaction avec les IDs PayPal
            $transaction->update([
                'paypal_payout_batch_id' => $result['batch_id'],
                'paypal_payout_item_id' => $result['item_id'],
            ]);

            return [
                'success' => true,
                'transfer_id' => $result['batch_id'],
            ];

        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
}
