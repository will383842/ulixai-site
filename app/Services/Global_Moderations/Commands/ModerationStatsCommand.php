<?php

namespace App\Services\Global_Moderations\Commands;

use App\Services\Global_Moderations\ModerationService;
use Illuminate\Console\Command;

class ModerationStatsCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'moderation:stats {--days=30 : Nombre de jours à analyser}';

    /**
     * The console command description.
     */
    protected $description = 'Affiche les statistiques de modération';

    /**
     * Execute the console command.
     */
    public function handle(ModerationService $moderationService): int
    {
        $days = (int) $this->option('days');
        $stats = $moderationService->getStats($days);

        $this->info("Statistiques de modération (derniers {$days} jours)");
        $this->newLine();

        $this->table(
            ['Métrique', 'Valeur'],
            [
                ['Total flags', $stats['total_flags']],
                ['Flags en attente', $stats['pending_flags']],
                ['Contenus bloqués aujourd\'hui', $stats['blocked_today']],
                ['Strikes émis', $stats['strikes_issued']],
                ['Utilisateurs bannis', $stats['users_banned']],
            ]
        );

        $this->newLine();
        $this->info('Répartition par type de flag:');

        $byType = collect($stats['by_type'])->map(fn($count, $type) => [$type, $count])->values()->toArray();

        if (!empty($byType)) {
            $this->table(['Type', 'Nombre'], $byType);
        } else {
            $this->line('Aucun flag enregistré.');
        }

        return Command::SUCCESS;
    }
}
