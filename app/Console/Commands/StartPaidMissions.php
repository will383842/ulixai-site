<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Mission;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class StartPaidMissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'missions:auto-start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically start missions that are paid but not started after 2 minutes';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Starting paid missions check...');
        $missionsToStart = Mission::where('payment_status', 'paid')
            ->where('status', 'waiting_to_start')
            ->where('updated_at', '<=', Carbon::now()->subHours(24))
            ->get();

        $missionsToRemove = Mission::where('payment_status', 'unpaid')
            ->where('status', 'published')
            ->get();

        $countStarted = 0;
        foreach ($missionsToStart as $mission) {
            $mission->status = 'in_progress';
            $mission->save();
            \Log::info("Mission #{$mission->id} automatically started after 24 hours of payment");
            $countStarted++;
        }
        $this->info("Completed! {$countStarted} missions were automatically started.");

        $allMissions = Mission::all();
        $countDeleted = 0;

        foreach ($allMissions as $mission) {
            $endTime = null;
            switch ($mission->service_durition) {
                case '1 week':
                    $endTime = \Carbon\Carbon::parse($mission->created_at)->addWeek();
                    break;
                case '2 weeks':
                    $endTime = \Carbon\Carbon::parse($mission->created_at)->addWeeks(2);
                    break;
                case '1 month':
                    $endTime = \Carbon\Carbon::parse($mission->created_at)->addMonth();
                    break;
                case '3 months':
                    $endTime = \Carbon\Carbon::parse($mission->created_at)->addMonths(3);
                    break;
            }

            // Delete mission if duration is completed
            if ($endTime && Carbon::now()->greaterThanOrEqualTo($endTime)) {
                $mission->delete();
                \Log::info("Mission #{$mission->id} deleted as its duration is completed.");
                $countDeleted++;
            }
        }

        $this->info("Completed! {$countDeleted} missions were deleted as their duration was completed.");

        return Command::SUCCESS;
    }

}
