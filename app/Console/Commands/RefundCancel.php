<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Mission;
use Stripe\Stripe;
use Stripe\Refund;
use Carbon\Carbon;
use App\Services\CurrencyService;
use Illuminate\Support\Facades\Log;

class RefundCancel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'missions:auto-cancel-refunds';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process refunds for cancelled missions within 24 hours';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Starting to process refunds for disputed missions...');

        $disputedMissions = Mission::where('status', 'disputed')
            ->where('payment_status', 'held')
            ->where('cancelled_on', '<=', Carbon::now()->subHours(24))
            ->get();


        if ($disputedMissions->isEmpty()) {
            return Command::SUCCESS;
        }

        foreach ($disputedMissions as $mission) {
            try {
                $this->processMissionRefund($mission);
                $this->info("Successfully processed refund for mission ID: {$mission->id}");
                Log::info("Successfully processed refund for mission ID: {$mission->id}");
            } catch (\Exception $e) {
                $this->error("Failed to process refund for mission ID: {$mission->id}. Error: {$e->getMessage()}");
                Log::error("Failed to process refund for mission ID: {$mission->id}. Error: {$e->getMessage()}");
            }
        }

        return Command::SUCCESS;
    }

    private function processMissionRefund($mission)
    {
        Stripe::setApiKey(config('services.stripe.secret'));
        
        $transaction = $mission->transactions()->where('status', 'paid')->first();
        
        if (!$transaction) {
            throw new \Exception('No paid transaction found for this mission');
        }

        $paymentIntent = \Stripe\PaymentIntent::retrieve($transaction->stripe_payment_intent_id);
        // ✅ Utiliser CurrencyService::toCents pour gérer les devises zero-decimal
        $missionAmount = $paymentIntent->metadata->mission_amount ?? null;
        $currency = $paymentIntent->metadata->currency ?? 'EUR';
        $refundAmountInCents = $missionAmount ? CurrencyService::toCents((float) $missionAmount, $currency) : null;

        if (!$refundAmountInCents) {
            throw new \Exception('Refund amount not found in metadata');
        }

        $refund = Refund::create([
            'payment_intent' => $paymentIntent->id,
            'amount' => (int) $refundAmountInCents,
        ]);

        if ($refund->status === 'succeeded') {
            $mission->status = 'cancelled';
            $mission->payment_status = 'refunded';
            $mission->selected_provider_id = null;
            $mission->save();
            
            $transaction->update(['status' => 'refunded']);
        } else {
            throw new \Exception('Refund failed with status: ' . $refund->status);
        }
    }
}
