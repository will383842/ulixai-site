<?php

namespace App\Services\Global_Moderations;

use Illuminate\Support\ServiceProvider;

class ModerationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Enregistrer les services de détection comme singletons
        $this->app->singleton(WordFilter::class, function ($app) {
            return new WordFilter();
        });

        $this->app->singleton(ContactDetector::class, function ($app) {
            return new ContactDetector();
        });

        $this->app->singleton(SpamDetector::class, function ($app) {
            return new SpamDetector();
        });

        // Enregistrer le SanctionManager
        $this->app->singleton(SanctionManager::class, function ($app) {
            return new SanctionManager(
                $app->make(\App\Services\Global_Notifications\NotificationService::class)
            );
        });

        // Enregistrer le service principal
        $this->app->singleton(ModerationService::class, function ($app) {
            return new ModerationService(
                $app->make(WordFilter::class),
                $app->make(ContactDetector::class),
                $app->make(SpamDetector::class),
                $app->make(SanctionManager::class),
                $app->make(\App\Services\Global_Notifications\NotificationService::class)
            );
        });

        // Enregistrer le ReportService
        $this->app->singleton(ReportService::class, function ($app) {
            return new ReportService(
                $app->make(SanctionManager::class),
                $app->make(SpamDetector::class),
                $app->make(\App\Services\Global_Notifications\NotificationService::class)
            );
        });

        // Enregistrer le AppealService
        $this->app->singleton(AppealService::class, function ($app) {
            return new AppealService(
                $app->make(SanctionManager::class),
                $app->make(\App\Services\Global_Notifications\NotificationService::class)
            );
        });

        // Alias pour faciliter l'injection
        $this->app->alias(ModerationService::class, 'moderation');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Publier la configuration
        $this->publishes([
            __DIR__ . '/../../config/moderations.php' => config_path('moderations.php'),
        ], 'moderation-config');

        // Charger les migrations
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        // Enregistrer les commandes Artisan
        if ($this->app->runningInConsole()) {
            $this->commands([
                Commands\CleanupExpiredStrikesCommand::class,
                Commands\ModerationStatsCommand::class,
            ]);
        }
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [
            WordFilter::class,
            ContactDetector::class,
            SpamDetector::class,
            SanctionManager::class,
            ModerationService::class,
            ReportService::class,
            AppealService::class,
            'moderation',
        ];
    }
}
