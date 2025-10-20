<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Mission;
use App\Services\PaymentService;
use App\Services\ReputationPointService;
use Carbon\Carbon;

class ReleasePendingPayments extends Command
{
    protected $signature = 'payment:release-pending';
    protected $description = 'Command description';
    protected $paymentService;
    protected $ReputationPointService;

    public function __construct(PaymentService $paymentService, ReputationPointService $ReputationPointService)
    {
        parent::__construct();
        $this->paymentService = $paymentService;
        $this->ReputationPointService = $ReputationPointService;
    }

    public function handle()
    {
        $this->info('Starting completed missions check...');
        $missionsToStart = Mission::where('payment_status', 'held')
            ->where('status', 'completed')
            ->where('updated_at', '<=', Carbon::now()->subHours(168))
            ->get();

        foreach ($missionsToStart as $mission) {
            $this->paymentService->transferFunds($mission, $mission->selectedProvider);
            $this->ReputationPointService->updateReputationPointsBasedOnMissionCompletedWithReviews($mission->selectedProvider);
            $mission->update(['payment_status' => 'released', 'status' => 'completed']);
        }

        $this->info('Completed missions check finished.');
    }
}
