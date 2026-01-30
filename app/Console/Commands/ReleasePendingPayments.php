<?php

namespace App\Console\Commands;

use App\Models\Mission;
use App\Models\Transaction;
use App\Services\Gateways\PayPalGateway;
use App\Services\PaymentService;
use App\Services\ReputationPointService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

/**
 * Libère automatiquement les paiements en escrow après la période définie.
 *
 * Supporte Stripe et PayPal:
 * - Stripe: Utilise PaymentService::transferFunds()
 * - PayPal: Utilise PayPalGateway::sendPayout()
 */
class ReleasePendingPayments extends Command
{
    protected $signature = 'payment:release-pending';
    protected $description = 'Release pending payments after escrow period (supports Stripe and PayPal)';

    protected PaymentService $paymentService;
    protected PayPalGateway $paypalGateway;
    protected ReputationPointService $reputationPointService;

    public function __construct(
        PaymentService $paymentService,
        PayPalGateway $paypalGateway,
        ReputationPointService $reputationPointService
    ) {
        parent::__construct();
        $this->paymentService = $paymentService;
        $this->paypalGateway = $paypalGateway;
        $this->reputationPointService = $reputationPointService;
    }

    public function handle(): int
    {
        $this->info('Starting escrow release check...');

        // Récupérer les transactions prêtes à être libérées
        $transactions = Transaction::releasable()
            ->with(['mission', 'provider', 'provider.user'])
            ->get();

        $this->info("Found {$transactions->count()} transactions ready for release.");

        $stripeCount = 0;
        $paypalCount = 0;
        $errorCount = 0;

        foreach ($transactions as $transaction) {
            $mission = $transaction->mission;
            $provider = $transaction->provider;

            if (!$mission || !$provider) {
                $this->warn("Transaction #{$transaction->id}: Missing mission or provider, skipping.");
                continue;
            }

            // Vérifier que la mission est bien completed
            if ($mission->status !== 'completed') {
                $this->warn("Transaction #{$transaction->id}: Mission not completed, skipping.");
                continue;
            }

            try {
                if ($transaction->is_stripe) {
                    // Libération Stripe
                    $this->releaseStripePayment($transaction, $mission, $provider);
                    $stripeCount++;
                } elseif ($transaction->is_paypal) {
                    // Libération PayPal
                    $this->releasePayPalPayment($transaction, $mission, $provider);
                    $paypalCount++;
                } else {
                    $this->warn("Transaction #{$transaction->id}: Unknown gateway, skipping.");
                    continue;
                }

                // Mettre à jour les points de réputation
                $this->reputationPointService->updateReputationPointsBasedOnMissionCompletedWithReviews($provider);

                $this->info("Transaction #{$transaction->id}: Released successfully via {$transaction->payment_gateway}");

            } catch (\Exception $e) {
                $errorCount++;
                Log::error('Payment release failed', [
                    'transaction_id' => $transaction->id,
                    'gateway' => $transaction->payment_gateway,
                    'error' => $e->getMessage(),
                ]);
                $this->error("Transaction #{$transaction->id}: Release failed - {$e->getMessage()}");

                // Marquer la raison du blocage
                $transaction->update([
                    'release_blocked_reason' => "Auto-release failed: {$e->getMessage()}",
                ]);
            }
        }

        $this->info("Release complete: Stripe={$stripeCount}, PayPal={$paypalCount}, Errors={$errorCount}");

        return self::SUCCESS;
    }

    /**
     * Libère un paiement Stripe.
     */
    private function releaseStripePayment(Transaction $transaction, Mission $mission, $provider): void
    {
        // Utiliser le service existant
        $result = $this->paymentService->transferFunds($mission, $provider);

        if (isset($result['already_transferred']) && $result['already_transferred']) {
            // Déjà transféré, juste mettre à jour le statut
            Log::info('Stripe payment already transferred', [
                'transaction_id' => $transaction->id,
            ]);
        }

        // Mettre à jour la transaction et la mission
        $transaction->update([
            'status' => 'released',
            'released_at' => now(),
        ]);

        $mission->update([
            'payment_status' => 'released',
        ]);
    }

    /**
     * Libère un paiement PayPal via Payouts API.
     */
    private function releasePayPalPayment(Transaction $transaction, Mission $mission, $provider): void
    {
        // Calculer le montant à envoyer (montant - frais prestataire)
        $amountPaid = (float) $transaction->amount_paid;
        $providerFee = (float) $transaction->provider_fee;
        $payoutAmount = $amountPaid - $providerFee;

        if ($payoutAmount <= 0) {
            throw new \Exception("Invalid payout amount: {$payoutAmount}");
        }

        // Envoyer le payout
        $result = $this->paypalGateway->sendPayout(
            $provider,
            $payoutAmount,
            $transaction->currency,
            "Payment for mission: {$mission->title}",
            [
                'mission_id' => $mission->id,
                'transaction_id' => $transaction->id,
            ]
        );

        // Mettre à jour la transaction
        $transaction->update([
            'paypal_payout_batch_id' => $result['batch_id'],
            'paypal_payout_item_id' => $result['item_id'],
            'status' => 'released',
            'released_at' => now(),
        ]);

        // Mettre à jour la mission
        $mission->update([
            'payment_status' => 'released',
        ]);

        Log::info('PayPal payout sent', [
            'transaction_id' => $transaction->id,
            'batch_id' => $result['batch_id'],
            'amount' => $payoutAmount,
            'currency' => $transaction->currency,
        ]);
    }
}
