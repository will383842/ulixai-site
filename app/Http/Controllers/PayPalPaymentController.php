<?php

namespace App\Http\Controllers;

use App\Http\Requests\Payment\CheckoutRequest;
use App\Models\Mission;
use App\Models\MissionOffer;
use App\Models\Transaction;
use App\Models\UlixCommission;
use App\Services\CurrencyService;
use App\Services\Gateways\PayPalGateway;
use App\Services\Gateways\PaymentGatewaySelector;
use App\Services\AuditLogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Contrôleur pour les paiements PayPal.
 */
class PayPalPaymentController extends Controller
{
    private PayPalGateway $paypalGateway;
    private CurrencyService $currencyService;
    private PaymentGatewaySelector $gatewaySelector;

    public function __construct(
        PayPalGateway $paypalGateway,
        CurrencyService $currencyService,
        PaymentGatewaySelector $gatewaySelector
    ) {
        $this->paypalGateway = $paypalGateway;
        $this->currencyService = $currencyService;
        $this->gatewaySelector = $gatewaySelector;
    }

    /**
     * Crée une commande PayPal pour une mission.
     */
    public function checkout(CheckoutRequest $request)
    {
        $mission = Mission::findOrFail($request->mission_id);
        $provider = \App\Models\ServiceProvider::findOrFail($request->provider_id);
        $offer = MissionOffer::findOrFail($request->offer_id);

        // Vérifications de sécurité
        if ($mission->requester_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'error' => __('You are not authorized to pay for this mission.'),
            ], 403);
        }

        if ($mission->payment_status === 'paid') {
            return response()->json([
                'success' => false,
                'error' => __('This mission is already paid.'),
            ], 400);
        }

        // Récupérer les montants
        $amount = (float) $request->amount;
        $clientFee = (float) $request->client_fee;
        $currency = strtoupper($mission->budget_currency ?? 'EUR');

        // Valider la devise
        $supportedCurrencies = $this->currencyService->getSupportedCurrencies();
        if (!in_array($currency, $supportedCurrencies)) {
            $currency = 'EUR';
        }

        // Vérification du calcul des frais
        $expectedTotal = $amount + $clientFee;
        $providedTotal = (float) $request->total;
        if (abs($expectedTotal - $providedTotal) > 0.01) {
            return response()->json([
                'success' => false,
                'error' => __('Invalid fee calculation.'),
            ], 400);
        }

        try {
            // Créer la commande PayPal
            $returnUrl = route('payments.paypal.capture', ['mission' => $mission->id]);
            $cancelUrl = route('payments.paypal.cancel');

            $order = $this->paypalGateway->createOrder(
                $mission,
                $offer,
                $amount,
                $clientFee,
                $currency,
                $returnUrl,
                $cancelUrl
            );

            Log::info('PayPal checkout initiated', [
                'mission_id' => $mission->id,
                'order_id' => $order['order_id'],
                'amount' => $amount + $clientFee,
                'currency' => $currency,
            ]);

            return response()->json([
                'success' => true,
                'order_id' => $order['order_id'],
                'approval_url' => $order['approval_url'],
            ]);

        } catch (\Exception $e) {
            Log::error('PayPal checkout failed', [
                'mission_id' => $mission->id,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'error' => __('Payment initialization failed. Please try again.'),
            ], 500);
        }
    }

    /**
     * Capture le paiement PayPal après approbation.
     */
    public function capture(Request $request, Mission $mission)
    {
        $orderId = $request->get('token'); // PayPal retourne le token comme order ID

        if (!$orderId) {
            return redirect()->route('payments.paypal.cancel')
                ->with('error', __('Invalid payment session.'));
        }

        // Vérifier que c'est bien le requester
        if ($mission->requester_id !== auth()->id()) {
            return redirect()->route('payments.paypal.cancel')
                ->with('error', __('Unauthorized.'));
        }

        // Vérifier que la mission n'est pas déjà payée
        if ($mission->payment_status === 'paid') {
            return redirect()->route('payments.success', $mission)
                ->with('info', __('This mission is already paid.'));
        }

        try {
            // Capturer le paiement
            $capture = $this->paypalGateway->captureOrder($orderId);

            if ($capture['status'] !== 'COMPLETED') {
                Log::warning('PayPal capture not completed', [
                    'order_id' => $orderId,
                    'status' => $capture['status'],
                ]);

                return redirect()->route('payments.paypal.cancel')
                    ->with('error', __('Payment was not completed. Please try again.'));
            }

            // Le webhook va gérer la mise à jour de la transaction
            // Mais on peut aussi le faire ici pour une réponse immédiate

            // Récupérer les métadonnées
            $metadata = json_decode($capture['custom_id'] ?? '{}', true);
            $providerId = $metadata['provider_id'] ?? null;
            $offerId = $metadata['offer_id'] ?? null;
            $clientFee = $metadata['client_fee'] ?? 0;

            if ($providerId && $offerId) {
                $this->processPaymentSuccess(
                    $mission,
                    $orderId,
                    $capture['capture_id'],
                    $capture['amount'],
                    $capture['currency'],
                    $providerId,
                    $offerId,
                    $clientFee
                );
            }

            Log::info('PayPal payment captured successfully', [
                'mission_id' => $mission->id,
                'order_id' => $orderId,
                'capture_id' => $capture['capture_id'],
            ]);

            return redirect()->route('payments.success', $mission)
                ->with('success', __('Payment successful!'));

        } catch (\Exception $e) {
            Log::error('PayPal capture failed', [
                'mission_id' => $mission->id,
                'order_id' => $orderId,
                'error' => $e->getMessage(),
            ]);

            return redirect()->route('payments.paypal.cancel')
                ->with('error', __('Payment capture failed. Please contact support.'));
        }
    }

    /**
     * Page d'annulation de paiement PayPal.
     */
    public function cancel()
    {
        return view('dashboard.payments-cancel');
    }

    /**
     * Traite le succès du paiement (appelé après capture).
     */
    private function processPaymentSuccess(
        Mission $mission,
        string $orderId,
        string $captureId,
        float $amount,
        string $currency,
        int $providerId,
        int $offerId,
        float $clientFee
    ): void {
        $commission = UlixCommission::first();
        $escrowDays = config('ulixai.payment.escrow_period_days', 7);

        DB::transaction(function () use (
            $mission,
            $orderId,
            $captureId,
            $amount,
            $currency,
            $providerId,
            $offerId,
            $clientFee,
            $commission,
            $escrowDays
        ) {
            // Vérifier idempotence
            $existing = Transaction::where('paypal_order_id', $orderId)->first();
            if ($existing) {
                return; // Déjà traité
            }

            // Mettre à jour la mission
            $mission->update([
                'status' => 'waiting_to_start',
                'payment_status' => 'paid',
                'selected_provider_id' => $providerId,
            ]);

            // Mettre à jour l'offre
            $offer = MissionOffer::find($offerId);
            if ($offer) {
                $offer->update(['status' => 'accepted']);
            }

            // Calculer les frais
            $minimumServiceFee = CurrencyService::getMinimumServiceFeeStatic($currency);
            $calculatedProviderFee = round($amount * ($commission->provider_fee ?? 0.15), 2);
            $providerFee = max($calculatedProviderFee, $minimumServiceFee);

            // Date de libération
            $releaseScheduledAt = now()->addDays($escrowDays);

            // Créer la transaction
            $transaction = Transaction::create([
                'mission_id' => $mission->id,
                'provider_id' => $providerId,
                'offer_id' => $offerId,
                'payment_gateway' => Transaction::GATEWAY_PAYPAL,
                'paypal_order_id' => $orderId,
                'paypal_capture_id' => $captureId,
                'amount_paid' => $amount,
                'client_fee' => round($clientFee, 2),
                'provider_fee' => $providerFee,
                'country' => $mission->location_country,
                'currency' => strtoupper($currency),
                'user_role' => 'service_requester',
                'status' => 'paid',
                'authorized_at' => now(),
                'captured_at' => now(),
                'release_scheduled_at' => $releaseScheduledAt,
            ]);

            // Audit log
            AuditLogService::logPayment($transaction);
        }, 5);
    }

    /**
     * Retourne les informations de passerelle pour une mission.
     */
    public function getGatewayInfo(Request $request)
    {
        $countryCode = $request->get('country', 'FR');

        return response()->json([
            'success' => true,
            'recommended' => $this->gatewaySelector->selectForCountry($countryCode),
            'gateways' => $this->gatewaySelector->getAllGatewaysInfo($countryCode),
        ]);
    }
}
