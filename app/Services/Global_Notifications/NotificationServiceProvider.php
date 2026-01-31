<?php

namespace App\Services\Global_Notifications;

use Illuminate\Support\ServiceProvider;

class NotificationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Enregistrer le NotificationService comme singleton
        $this->app->singleton(NotificationService::class, function ($app) {
            return new NotificationService();
        });

        // Alias pour faciliter l'injection
        $this->app->alias(NotificationService::class, 'notifications');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Rien à faire pour le moment
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [
            NotificationService::class,
            'notifications',
        ];
    }
}
