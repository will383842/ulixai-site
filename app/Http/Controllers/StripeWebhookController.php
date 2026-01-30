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

        // Gérer l'événement payment_intent.succeeded
        if ($event->type === 'payment_intent.succeeded') {
            $paymentIntent = $event->data->object;
            $this->handlePaymentSuccess($paymentIntent);
        }

        // Gérer payment_intent.payment_failed (optionnel)
        if ($event->type === 'payment_intent.payment_failed') {
            $paymentIntent = $event->data->object;
            Log::warning('⚠️ Payment failed for PaymentIntent: ' . $paymentIntent->id, [
                'mission_id' => $paymentIntent->metadata->mission_id ?? null,
                'error' => $paymentIntent->last_payment_error->message ?? 'Unknown error'
            ]);
        }

        return response()->json(['status' => 'success'], 200);
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
        }
    }
}