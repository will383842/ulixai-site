<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mission;
use App\Models\MissionOffer;
use App\Models\Transaction;
use App\Models\UlixCommission;
use Stripe\Webhook;
use Illuminate\Support\Facades\Log;

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
     */
    private function handlePaymentSuccess($paymentIntent)
    {
        $missionId = $paymentIntent->metadata->mission_id ?? null;
        $providerId = $paymentIntent->metadata->provider_id ?? null;
        $offerId = $paymentIntent->metadata->offer_id ?? null;
        $clientFee = $paymentIntent->metadata->client_fee ?? 0;
        $missionAmount = $paymentIntent->metadata->mission_amount ?? 0;

        // Validation des métadonnées
        if (!$missionId || !$providerId || !$offerId) {
            Log::error('❌ Missing metadata in payment intent: ' . $paymentIntent->id);
            return;
        }

        $mission = Mission::find($missionId);
        if (!$mission) {
            Log::error('❌ Mission not found: ' . $missionId);
            return;
        }

        // ✅ Vérifier si déjà traité (évite les doublons)
        $existingTransaction = Transaction::where('stripe_payment_intent_id', $paymentIntent->id)->first();
        if ($existingTransaction) {
            Log::info('ℹ️ Payment already processed via webhook: ' . $paymentIntent->id);
            return;
        }

        $commission = UlixCommission::first();

        try {
            // ✅ Mettre à jour la mission
            $mission->update([
                'status' => 'waiting_to_start',
                'payment_status' => 'paid',
                'selected_provider_id' => $providerId,
            ]);

            // ✅ Mettre à jour l'offre
            $missionOffer = MissionOffer::find($offerId);
            if ($missionOffer) {
                $missionOffer->update(['status' => 'accepted']);
            }

            // ✅ Créer la transaction
            Transaction::create([
                'mission_id' => $missionId,
                'provider_id' => $providerId,
                'offer_id' => $offerId,
                'stripe_payment_intent_id' => $paymentIntent->id,
                'amount_paid' => $paymentIntent->amount / 100,
                'client_fee' => $clientFee,
                'provider_fee' => ($paymentIntent->amount / 100) * $commission->provider_fee,
                'country' => $mission->location_country,
                'user_role' => 'service_requester',
                'status' => 'paid',
            ]);

            Log::info('✅ Payment processed successfully via webhook', [
                'payment_intent_id' => $paymentIntent->id,
                'mission_id' => $missionId,
                'provider_id' => $providerId,
                'amount' => $paymentIntent->amount / 100
            ]);

        } catch (\Exception $e) {
            Log::error('❌ Error processing payment webhook: ' . $e->getMessage(), [
                'payment_intent_id' => $paymentIntent->id,
                'mission_id' => $missionId,
                'trace' => $e->getTraceAsString()
            ]);
        }
    }
}