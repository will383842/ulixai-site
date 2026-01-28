<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use App\Models\NotificationPreference;
use App\Services\NotificationService;

abstract class BaseNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Type de notification (dispute, payment, mission, message, account)
     */
    protected string $type = 'account';

    /**
     * Détermine les canaux de diffusion selon les préférences utilisateur
     */
    public function via($notifiable): array
    {
        $channels = [];

        if (NotificationPreference::isEnabled($notifiable->id, NotificationService::CHANNEL_EMAIL, $this->type)) {
            $channels[] = 'mail';
        }

        if (NotificationPreference::isEnabled($notifiable->id, NotificationService::CHANNEL_DATABASE, $this->type)) {
            $channels[] = 'database';
        }

        // Si aucun canal configuré, utiliser les deux par défaut
        if (empty($channels)) {
            $channels = ['mail', 'database'];
        }

        return $channels;
    }

    /**
     * Langue de l'utilisateur pour les traductions
     */
    protected function getUserLocale($notifiable): string
    {
        return $notifiable->preferred_language ?? config('app.locale', 'fr');
    }

    /**
     * Traduit un texte selon la langue de l'utilisateur
     */
    protected function trans(string $key, array $replace = [], $notifiable = null): string
    {
        $locale = $notifiable ? $this->getUserLocale($notifiable) : 'fr';
        return __($key, $replace, $locale);
    }
}
