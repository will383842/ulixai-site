<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mission;
use App\Models\MissionOffer;
use App\Models\Transaction;
use App\Models\UlixCommission;
use Stripe\Webhook;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Services\AuditLogService;
use App\Services\CurrencyService;

class StripeWebhookController extends Controller
{
    /**
     * ✅ Gère les webhooks Stripe (sécurité ultime)
     * Cette méthode est appelée directement par Stripe quand un paiement est confirmé
     */
    public function handleWebhook(Request $request)
    {
        $endpointSecret = config('services.stripe.webhook_secret');
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');

        // Vérification de la signature Stripe (sécurité)
        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $endpointSecret);
        } catch (\UnexpectedValueException $e) {
            Log::error('❌ Webhook invalid payload: ' . $e->getMessage());
            return response()->json(['error' => 'Invalid payload'], 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            Log::error('❌ Webhook signature verification failed: ' . $e->getMessage());
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        try {
            match ($event->type) {
                'payment_intent.succeeded' => $this->handlePaymentSuccess($event->data->object),
                'payment_intent.payment_failed' => $this->handlePaymentFailed($event->data->object),
                'charge.dispute.created' => $this->handleDisputeCreated($event->data->object),
                'charge.dispute.updated' => $this->handleDisputeUpdated($event->data->object),
                'charge.dispute.funds_withdrawn' => $this->handleDisputeFundsWithdrawn($event->data->object),
                'charge.dispute.closed' => $this->handleDisputeClosed($event->data->object),
                default => Log::debug('Stripe webhook unhandled: ' . $event->type),
            };
        } catch (\Exception $e) {
            Log::error('❌ Webhook handler failed: ' . $e->getMessage(), [
                'event_type' => $event->type,
                'trace' => $e->getTraceAsString(),
            ]);
            return response()->json(['error' => 'Processing failed'], 500);
        }

        return response()->json(['status' => 'success'], 200);
    }

    private function handlePaymentFailed($paymentIntent): void
    {
        Log::warning('⚠️ Payment failed for PaymentIntent: ' . $paymentIntent->id, [
            'mission_id' => $paymentIntent->metadata->mission_id ?? null,
            'error' => $paymentIntent->last_payment_error->message ?? 'Unknown error',
        ]);
    }

    /**
     * Dispute ouverte par le client — bloquer immédiatement les fonds escrow.
     * Stripe débite automatiquement si la dispute n'est pas contestée.
     */
    private function handleDisputeCreated(object $dispute): void
    {
        $transaction = Transaction::where('stripe_payment_intent_id', $dispute->payment_intent)->first();

        if (!$transaction) {
            Log::error('Dispute created: transaction not found', ['payment_intent' => $dispute->payment_intent, 'dispute_id' => $dispute->id]);
            return;
        }

        DB::transaction(function () use ($transaction, $dispute) {
            $transaction->update([
                'status' => 'disputed',
                'dispute_id' => $dispute->id,
                'dispute_reason' => $dispute->reason,
                'dispute_status' => $dispute->status,
                'disputed_at' => now(),
            ]);

            if ($transaction->mission) {
                $transaction->mission->update(['status' => 'disputed']);
            }
        });

        $this->notifyAdminDispute('created', $transaction, $dispute);

        Log::critical('💥 Stripe dispute CREATED', [
            'dispute_id' => $dispute->id,
            'payment_intent' => $dispute->payment_intent,
            'transaction_id' => $transaction->id,
            'mission_id' => $transaction->mission_id,
            'amount' => $dispute->amount / 100,
            'reason' => $dispute->reason,
        ]);
    }

    /**
     * Statut de la dispute mis à jour par Stripe.
     */
    private function handleDisputeUpdated(object $dispute): void
    {
        $transaction = Transaction::where('stripe_payment_intent_id', $dispute->payment_intent)->first();

        if (!$transaction) {
            return;
        }

        $transaction->update([
            'dispute_status' => $dispute->status,
        ]);

        Log::info('Stripe dispute updated', [
            'dispute_id' => $dispute->id,
            'status' => $dispute->status,
            'transaction_id' => $transaction->id,
        ]);
    }

    /**
     * Stripe a prélevé les fonds (dispute perdue ou en cours) — alerte critique.
     */
    private function handleDisputeFundsWithdrawn(object $dispute): void
    {
        $transaction = Transaction::where('stripe_payment_intent_id', $dispute->payment_intent)->first();

        if ($transaction) {
            $transaction->update(['status' => 'dispute_funds_withdrawn', 'dispute_status' => $dispute->status]);
        }

        $this->notifyAdminDispute('funds_withdrawn', $transaction, $dispute);

        Log::critical('💸 Stripe dispute FUNDS WITHDRAWN', [
            'dispute_id' => $dispute->id,
            'payment_intent' => $dispute->payment_intent,
            'amount_withdrawn' => $dispute->amount / 100,
        ]);
    }

    /**
     * Dispute fermée (won = on récupère les fonds, lost = fonds définitivement perdus).
     */
    private function handleDisputeClosed(object $dispute): void
    {
        $transaction = Transaction::where('stripe_payment_intent_id', $dispute->payment_intent)->first();

        if (!$transaction) {
            return;
        }

        if ($dispute->status === 'won') {
            // Dispute gagnée : remettre la transaction en état normal
            $transaction->update(['status' => 'paid', 'dispute_status' => 'won']);
            if ($transaction->mission) {
                $transaction->mission->update(['status' => 'completed']);
            }
            Log::info('✅ Stripe dispute WON', ['dispute_id' => $dispute->id, 'transaction_id' => $transaction->id]);
        } else {
            // Dispute perdue : marquer comme remboursé (fonds déjà prélevés par Stripe)
            $transaction->update(['status' => 'refunded', 'dispute_status' => 'lost']);
            if ($transaction->mission) {
                $transaction->mission->update(['status' => 'refunded']);
            }
            Log::critical('❌ Stripe dispute LOST', ['dispute_id' => $dispute->id, 'transaction_id' => $transaction->id]);
        }

        $this->notifyAdminDispute('closed_' . $dispute->status, $transaction, $dispute);
    }

    /**
     * Notifie l'admin par email lors d'un événement de dispute.
     */
    private function notifyAdminDispute(string $event, ?Transaction $transaction, object $dispute): void
    {
        $adminEmail = config('mail.admin_address', config('mail.from.address'));
        if (!$adminEmail) {
            return;
        }

        $body = "Stripe Dispute Event: {$event}\n"
            . "Dispute ID: {$dispute->id}\n"
            . "Payment Intent: {$dispute->payment_intent}\n"
            . "Reason: {$dispute->reason}\n"
            . "Status: {$dispute->status}\n"
            . "Amount: " . ($dispute->amount / 100) . " " . strtoupper($dispute->currency) . "\n";

        if ($transaction) {
            $body .= "Transaction ID: {$transaction->id}\n"
                . "Mission ID: {$transaction->mission_id}\n";
        }

        dispatch(function () use ($adminEmail, $event, $body) {
            try {
                Mail::raw($body, function ($mail) use ($adminEmail, $event) {
                    $mail->to($adminEmail)->subject("[ULIXAI] Stripe Dispute {$event}");
                });
            } catch (\Throwable $e) {
                Log::error('Failed to send dispute notification email', ['error' => $e->getMessage()]);
            }
        })->afterResponse();
    }

    /**
     * ✅ Traite un paiement réussi (double sécurité avec processPayment)
     * ✅ SÉCURITÉ: Utilise une transaction DB avec lock pour éviter les race conditions
     */
    private function handlePaymentSuccess($paymentIntent)
    {
        $missionId = $paymentIntent->metadata->mission_id ?? null;
        $providerId = $paymentIntent->metadata->provider_id ?? null;
        $offerId = $paymentIntent->metadata->offer_id ?? null;
        $clientFee = $paymentIntent->metadata->client_fee ?? 0;
        $missionAmount = $paymentIntent->metadata->mission_amount ?? 0;

        // ✅ Récupérer la devise depuis Stripe (EUR ou USD)
        $currency = strtoupper($paymentIntent->currency ?? 'EUR');

        // ✅ SÉCURITÉ: Validation des métadonnées (type et présence)
        if (!$missionId || !$providerId || !$offerId) {
            Log::error('❌ Missing metadata in payment intent: ' . $paymentIntent->id);
            return;
        }

        // ✅ SÉCURITÉ: Valider que les IDs sont des entiers
        if (!is_numeric($missionId) || !is_numeric($providerId) || !is_numeric($offerId)) {
            Log::error('❌ Invalid metadata types in payment intent: ' . $paymentIntent->id);
            return;
        }

        $mission = Mission::find($missionId);
        if (!$mission) {
            Log::error('❌ Mission not found: ' . $missionId);
            return;
        }

        // ✅ SÉCURITÉ: Vérification rapide avant le lock (optimisation)
        if ($mission->payment_status === 'paid') {
            Log::info('ℹ️ Mission already paid, skipping: ' . $missionId);
            return;
        }

        $commission = UlixCommission::first();
        if (!$commission) {
            throw new \RuntimeException('Commission configuration not found. Please configure platform fees in admin.');
        }

        // ✅ SÉCURITÉ: Transaction DB avec lock pour éviter les race conditions
        try {
            DB::transaction(function () use ($paymentIntent, $missionId, $providerId, $offerId, $clientFee, $mission, $commission, $currency) {
                // ✅ Lock pessimiste sur Transaction ET Mission
                $existingTransaction = Transaction::where('stripe_payment_intent_id', $paymentIntent->id)
                    ->lockForUpdate()
                    ->first();

                if ($existingTransaction) {
                    Log::info('ℹ️ Payment already processed via webhook: ' . $paymentIntent->id);
                    return;
                }

                // ✅ Lock sur la mission aussi pour éviter modifications concurrentes
                $lockedMission = Mission::where('id', $missionId)->lockForUpdate()->first();
                if (!$lockedMission || $lockedMission->payment_status === 'paid') {
                    Log::info('ℹ️ Mission already paid (locked check): ' . $missionId);
                    return;
                }

                // ✅ Mettre à jour la mission
                $lockedMission->update([
                    'status' => 'waiting_to_start',
                    'payment_status' => 'paid',
                    'selected_provider_id' => $providerId,
                ]);

                // ✅ Mettre à jour l'offre
                $missionOffer = MissionOffer::find($offerId);
                if ($missionOffer) {
                    $missionOffer->update(['status' => 'accepted']);
                }

                // ✅ Créer la transaction avec CurrencyService pour gérer les devises zero-decimal
                $amountPaid = CurrencyService::fromCents($paymentIntent->amount, $currency);

                // ✅ Calculer les frais prestataire avec le minimum appliqué
                $calculatedProviderFee = round($amountPaid * $commission->provider_fee, 2);
                $minimumServiceFee = CurrencyService::getMinimumServiceFeeStatic($currency);
                $providerFee = max($calculatedProviderFee, $minimumServiceFee);

                // ✅ Calculer la date de libération escrow
                $escrowDays = config('ulixai.payment.escrow_period_days', 7);
                $releaseScheduledAt = now()->addDays($escrowDays);

                $transaction = Transaction::create([
                    'mission_id' => $missionId,
                    'provider_id' => $providerId,
                    'offer_id' => $offerId,
                    'payment_gateway' => 'stripe', // ✅ Gateway explicite
                    'stripe_payment_intent_id' => $paymentIntent->id,
                    'amount_paid' => $amountPaid,
                    'client_fee' => round((float) $clientFee, 2),
                    'provider_fee' => $providerFee,
                    'country' => $lockedMission->location_country,
                    'currency' => $currency, // ✅ Devise récupérée depuis Stripe (EUR ou USD)
                    'user_role' => 'service_requester', // Correct: seul le requester paie
                    'status' => 'paid',
                    // ✅ Champs escrow pour libération automatique
                    'authorized_at' => now(),
                    'captured_at' => now(),
                    'release_scheduled_at' => $releaseScheduledAt,
                ]);

                // ✅ Log critique pour traçabilité
                AuditLogService::logPayment($transaction);

                Log::info('✅ Payment processed successfully via webhook', [
                    'payment_intent_id' => $paymentIntent->id,
                    'mission_id' => $missionId,
                    'provider_id' => $providerId,
                    'amount' => $amountPaid,
                    'currency' => $currency
                ]);
            }, 5); // 5 tentatives en cas de deadlock

        } catch (\Exception $e) {
            Log::error('❌ Error processing payment webhook: ' . $e->getMessage(), [
                'payment_intent_id' => $paymentIntent->id,
                'mission_id' => $missionId,
                'trace' => $e->getTraceAsString()
            ]);
            throw $e; // Re-throw so handleWebhook returns HTTP 500 → Stripe will retry
        }
    }
}