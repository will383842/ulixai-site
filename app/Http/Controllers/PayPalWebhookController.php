<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Models\MissionOffer;
use App\Models\Transaction;
use App\Models\UlixCommission;
use App\Services\AuditLogService;
use App\Services\CurrencyService;
use App\Services\Gateways\PayPalGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Contrôleur pour les webhooks PayPal.
 *
 * Gère les événements PayPal pour confirmer les paiements et payouts.
 */
class PayPalWebhookController extends Controller
{
    private PayPalGateway $paypalGateway;

    public function __construct(PayPalGateway $paypalGateway)
    {
        $this->paypalGateway = $paypalGateway;
    }

    /**
     * Gère les webhooks PayPal.
     */
    public function handleWebhook(Request $request)
    {
        // Récupérer les headers PayPal
        $headers = [
            'PAYPAL-AUTH-ALGO' => $request->header('PAYPAL-AUTH-ALGO'),
            'PAYPAL-CERT-URL' => $request->header('PAYPAL-CERT-URL'),
            'PAYPAL-TRANSMISSION-ID' => $request->header('PAYPAL-TRANSMISSION-ID'),
            'PAYPAL-TRANSMISSION-SIG' => $request->header('PAYPAL-TRANSMISSION-SIG'),
            'PAYPAL-TRANSMISSION-TIME' => $request->header('PAYPAL-TRANSMISSION-TIME'),
        ];

        $rawBody = $request->getContent();

        // Vérifier la signature
        if (!$this->paypalGateway->verifyWebhookSignature($headers, $rawBody)) {
            Log::error('PayPal webhook signature verification failed');
            return response()->json(['error' => 'Invalid signature'], 401);
        }

        $event = json_decode($rawBody, true);
        $eventType = $event['event_type'] ?? '';
        $eventId = $event['id'] ?? '';
        $resource = $event['resource'] ?? [];

        Log::info('PayPal webhook received', [
            'event_type' => $eventType,
            'event_id' => $eventId,
        ]);

        // Router vers le bon handler
        switch ($eventType) {
            case 'CHECKOUT.ORDER.APPROVED':
                $this->handleOrderApproved($resource, $eventId);
                break;

            case 'PAYMENT.CAPTURE.COMPLETED':
                $this->handleCaptureCompleted($resource, $eventId);
                break;

            case 'PAYMENT.CAPTURE.DENIED':
            case 'PAYMENT.CAPTURE.DECLINED':
                $this->handleCaptureFailed($resource, $eventId);
                break;

            case 'PAYMENT.PAYOUTSBATCH.SUCCESS':
                $this->handlePayoutSuccess($resource, $eventId);
                break;

            case 'PAYMENT.PAYOUTSBATCH.DENIED':
                $this->handlePayoutFailed($resource, $eventId);
                break;

            case 'CUSTOMER.DISPUTE.CREATED':
                $this->handleDisputeCreated($resource, $eventId);
                break;

            case 'CUSTOMER.DISPUTE.RESOLVED':
                $this->handleDisputeResolved($resource, $eventId);
                break;

            default:
                Log::debug('PayPal webhook event not handled', [
                    'event_type' => $eventType,
                ]);
        }

        return response()->json(['status' => 'success'], 200);
    }

    /**
     * Gère l'approbation d'une commande (avant capture).
     */
    private function handleOrderApproved(array $resource, string $eventId): void
    {
        $orderId = $resource['id'] ?? null;

        if (!$orderId) {
            Log::warning('PayPal order approved without order ID', [
                'event_id' => $eventId,
            ]);
            return;
        }

        Log::info('PayPal order approved, ready for capture', [
            'order_id' => $orderId,
            'event_id' => $eventId,
        ]);

        // Note: La capture est généralement initiée par le frontend après redirection
        // Ce webhook sert principalement de confirmation/logging
    }

    /**
     * Gère une capture réussie (paiement confirmé).
     */
    private function handleCaptureCompleted(array $resource, string $eventId): void
    {
        $captureId = $resource['id'] ?? null;
        $orderId = $resource['supplementary_data']['related_ids']['order_id'] ?? null;
        $amount = (float) ($resource['amount']['value'] ?? 0);
        $currency = $resource['amount']['currency_code'] ?? 'EUR';

        // Récupérer le custom_id avec les métadonnées
        $customId = $resource['custom_id'] ?? null;
        $metadata = $customId ? json_decode($customId, true) : null;

        if (!$metadata) {
            // Essayer de récupérer depuis l'ordre parent
            try {
                $order = $this->paypalGateway->getOrder($orderId);
                $customId = $order['purchase_units'][0]['custom_id'] ?? null;
                $metadata = $customId ? json_decode($customId, true) : null;
            } catch (\Exception $e) {
                Log::error('PayPal capture: unable to get order details', [
                    'order_id' => $orderId,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        if (!$metadata) {
            Log::error('PayPal capture completed but no metadata found', [
                'capture_id' => $captureId,
                'order_id' => $orderId,
                'event_id' => $eventId,
            ]);
            return;
        }

        $missionId = $metadata['mission_id'] ?? null;
        $providerId = $metadata['provider_id'] ?? null;
        $offerId = $metadata['offer_id'] ?? null;
        $clientFee = $metadata['client_fee'] ?? 0;

        if (!$missionId || !$providerId || !$offerId) {
            Log::error('PayPal capture: missing required metadata', [
                'metadata' => $metadata,
                'event_id' => $eventId,
            ]);
            return;
        }

        $mission = Mission::find($missionId);
        if (!$mission) {
            Log::error('PayPal capture: mission not found', [
                'mission_id' => $missionId,
            ]);
            return;
        }

        // Vérification rapide avant le lock
        if ($mission->payment_status === 'paid') {
            Log::info('PayPal capture: mission already paid, skipping', [
                'mission_id' => $missionId,
            ]);
            return;
        }

        $commission = UlixCommission::first();
        $escrowDays = config('ulixai.payment.escrow_period_days', 7);

        try {
            DB::transaction(function () use (
                $captureId,
                $orderId,
                $missionId,
                $providerId,
                $offerId,
                $clientFee,
                $amount,
                $currency,
                $mission,
                $commission,
                $escrowDays
            ) {
                // Lock pessimiste
                $existingTransaction = Transaction::where('paypal_order_id', $orderId)
                    ->lockForUpdate()
                    ->first();

                if ($existingTransaction) {
                    Log::info('PayPal capture already processed', [
                        'order_id' => $orderId,
                    ]);
                    return;
                }

                // Lock sur la mission
                $lockedMission = Mission::where('id', $missionId)->lockForUpdate()->first();
                if (!$lockedMission || $lockedMission->payment_status === 'paid') {
                    Log::info('PayPal capture: mission already paid (locked check)', [
                        'mission_id' => $missionId,
                    ]);
                    return;
                }

                // Mettre à jour la mission
                $lockedMission->update([
                    'status' => 'waiting_to_start',
                    'payment_status' => 'paid',
                    'selected_provider_id' => $providerId,
                ]);

                // Mettre à jour l'offre
                $missionOffer = MissionOffer::find($offerId);
                if ($missionOffer) {
                    $missionOffer->update(['status' => 'accepted']);
                }

                // Calculer les frais prestataire avec minimum
                $minimumServiceFee = CurrencyService::getMinimumServiceFeeStatic($currency);
                $calculatedProviderFee = round($amount * $commission->provider_fee, 2);
                $providerFee = max($calculatedProviderFee, $minimumServiceFee);

                // Date de libération prévue (escrow)
                $releaseScheduledAt = now()->addDays($escrowDays);

                // Créer la transaction
                $transaction = Transaction::create([
                    'mission_id' => $missionId,
                    'provider_id' => $providerId,
                    'offer_id' => $offerId,
                    'payment_gateway' => Transaction::GATEWAY_PAYPAL,
                    'paypal_order_id' => $orderId,
                    'paypal_capture_id' => $captureId,
                    'amount_paid' => $amount,
                    'client_fee' => round((float) $clientFee, 2),
                    'provider_fee' => $providerFee,
                    'country' => $lockedMission->location_country,
                    'currency' => strtoupper($currency),
                    'user_role' => 'service_requester',
                    'status' => 'paid',
                    'authorized_at' => now(),
                    'captured_at' => now(),
                    'release_scheduled_at' => $releaseScheduledAt,
                ]);

                // Log audit
                AuditLogService::logPayment($transaction);

                Log::info('PayPal payment processed successfully', [
                    'order_id' => $orderId,
                    'capture_id' => $captureId,
                    'mission_id' => $missionId,
                    'provider_id' => $providerId,
                    'amount' => $amount,
                    'currency' => $currency,
                    'release_scheduled_at' => $releaseScheduledAt->toDateTimeString(),
                ]);
            }, 5); // 5 tentatives en cas de deadlock

        } catch (\Exception $e) {
            Log::error('PayPal capture processing error', [
                'order_id' => $orderId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }

    /**
     * Gère une capture échouée.
     */
    private function handleCaptureFailed(array $resource, string $eventId): void
    {
        $captureId = $resource['id'] ?? null;

        Log::warning('PayPal capture failed', [
            'capture_id' => $captureId,
            'event_id' => $eventId,
            'status' => $resource['status'] ?? 'UNKNOWN',
        ]);

        // TODO: Notifier l'utilisateur de l'échec du paiement
    }

    /**
     * Gère un payout réussi.
     */
    private function handlePayoutSuccess(array $resource, string $eventId): void
    {
        $batchId = $resource['batch_header']['payout_batch_id'] ?? null;
        $senderBatchId = $resource['batch_header']['sender_batch_header']['sender_batch_id'] ?? null;

        Log::info('PayPal payout batch success', [
            'batch_id' => $batchId,
            'sender_batch_id' => $senderBatchId,
            'event_id' => $eventId,
        ]);

        // Mettre à jour les transactions concernées
        $transaction = Transaction::where('paypal_payout_batch_id', $batchId)->first();

        if ($transaction) {
            $transaction->update([
                'status' => 'released',
                'released_at' => now(),
            ]);

            // Mettre à jour la mission
            $mission = $transaction->mission;
            if ($mission) {
                $mission->update(['payment_status' => 'released']);
            }

            Log::info('PayPal payout: transaction marked as released', [
                'transaction_id' => $transaction->id,
                'batch_id' => $batchId,
            ]);
        }
    }

    /**
     * Gère un payout échoué.
     */
    private function handlePayoutFailed(array $resource, string $eventId): void
    {
        $batchId = $resource['batch_header']['payout_batch_id'] ?? null;

        Log::error('PayPal payout batch failed', [
            'batch_id' => $batchId,
            'event_id' => $eventId,
        ]);

        // Marquer la transaction avec la raison du blocage
        $transaction = Transaction::where('paypal_payout_batch_id', $batchId)->first();

        if ($transaction) {
            $transaction->update([
                'release_blocked_reason' => 'PayPal payout failed',
            ]);

            Log::warning('PayPal payout: transaction blocked', [
                'transaction_id' => $transaction->id,
                'batch_id' => $batchId,
            ]);
        }

        // TODO: Alerter l'admin du payout échoué
    }

    /**
     * Gère la création d'un litige PayPal.
     */
    private function handleDisputeCreated(array $resource, string $eventId): void
    {
        $disputeId = $resource['dispute_id'] ?? null;
        $disputeAmount = $resource['dispute_amount']['value'] ?? null;

        Log::warning('PayPal dispute created', [
            'dispute_id' => $disputeId,
            'amount' => $disputeAmount,
            'event_id' => $eventId,
        ]);

        // Trouver la transaction associée via les disputed_transactions
        $disputedTransactions = $resource['disputed_transactions'] ?? [];
        foreach ($disputedTransactions as $disputed) {
            $captureId = $disputed['buyer_transaction_id'] ?? null;

            if ($captureId) {
                $transaction = Transaction::where('paypal_capture_id', $captureId)->first();

                if ($transaction) {
                    $transaction->update([
                        'status' => 'dispute_pending',
                        'release_blocked_reason' => "PayPal dispute: {$disputeId}",
                    ]);

                    // Mettre à jour la mission
                    $mission = $transaction->mission;
                    if ($mission) {
                        $mission->update([
                            'status' => 'disputed',
                            'payment_status' => 'held',
                        ]);
                    }

                    Log::info('PayPal dispute: transaction and mission updated', [
                        'transaction_id' => $transaction->id,
                        'mission_id' => $transaction->mission_id,
                        'dispute_id' => $disputeId,
                    ]);
                }
            }
        }

        // TODO: Notifier l'admin et les parties concernées
    }

    /**
     * Gère la résolution d'un litige PayPal.
     */
    private function handleDisputeResolved(array $resource, string $eventId): void
    {
        $disputeId = $resource['dispute_id'] ?? null;
        $outcome = $resource['dispute_outcome']['outcome_code'] ?? null;

        Log::info('PayPal dispute resolved', [
            'dispute_id' => $disputeId,
            'outcome' => $outcome,
            'event_id' => $eventId,
        ]);

        // TODO: Traiter selon l'outcome (RESOLVED_BUYER_FAVOR, RESOLVED_SELLER_FAVOR, etc.)
    }
}
