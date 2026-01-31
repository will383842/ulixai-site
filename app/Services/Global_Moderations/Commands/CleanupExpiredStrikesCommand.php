<?php

namespace App\Services\Global_Moderations\Commands;

use App\Services\Global_Moderations\SanctionManager;
use Illuminate\Console\Command;

class CleanupExpiredStrikesCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'moderation:cleanup-strikes';

    /**
     * The console command description.
     */
    protected $description = 'Nettoie les strikes expirés et met à jour les compteurs utilisateurs';

    /**
     * Execute the console command.
     */
    public function handle(SanctionManager $sanctionManager): int
    {
        $this->info('Nettoyage des strikes expirés...');

        $count = $sanctionManager->cleanupExpiredStrikes();

        $this->info("Terminé. {$count} strike(s) expiré(s) désactivé(s).");

        return Command::SUCCESS;
    }
}
