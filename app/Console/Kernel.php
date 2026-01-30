<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Démarrage automatique des missions payées après 24h
        $schedule->command('missions:auto-start')->everyMinute();

        // Remboursement automatique des missions disputées après 24h
        $schedule->command('missions:auto-cancel-refunds')->everyMinute();

        // Libération des paiements aux prestataires après 7 jours (escrow)
        $schedule->command('payment:release-pending')
            ->hourly()
            ->withoutOverlapping()
            ->runInBackground();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}