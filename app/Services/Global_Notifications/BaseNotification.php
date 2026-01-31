<?php

namespace App\Services\Global_Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\App;

abstract class BaseNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Nombre de tentatives max
     */
    public int $tries = 3;

    /**
     * Timeout en secondes
     */
    public int $timeout = 30;

    /**
     * Délai entre les tentatives (en secondes)
     */
    public array $backoff = [60, 180, 600];

    /**
     * Langue de la notification
     */
    protected ?string $locale = null;

    /**
     * Canaux par défaut
     */
    protected array $defaultChannels = ['mail', 'database'];

    /**
     * Définit la langue
     */
    public function locale(string $locale): self
    {
        $this->locale = $locale;
        return $this;
    }

    /**
     * Récupère la langue à utiliser
     */
    protected function getLocale($notifiable): string
    {
        return $this->locale
            ?? $notifiable->preferred_language
            ?? App::getLocale()
            ?? 'fr';
    }

    /**
     * Canaux de diffusion par défaut
     */
    public function via($notifiable): array
    {
        return $this->defaultChannels;
    }

    /**
     * Template email de base
     */
    protected function buildMailMessage(string $subject, array $lines, ?string $actionText = null, ?string $actionUrl = null): MailMessage
    {
        $mail = (new MailMessage())
            ->subject($subject)
            ->greeting('Bonjour,');

        foreach ($lines as $line) {
            $mail->line($line);
        }

        if ($actionText && $actionUrl) {
            $mail->action($actionText, $actionUrl);
        }

        $mail->salutation('L\'équipe Ulixai');

        return $mail;
    }

    /**
     * Structure de base pour le stockage en base
     */
    protected function buildDatabaseArray(string $type, string $title, string $message, ?string $actionUrl = null, array $extra = []): array
    {
        return array_merge([
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'action_url' => $actionUrl,
            'created_at' => now()->toISOString(),
        ], $extra);
    }

    /**
     * Détermine si la notification doit être envoyée
     */
    public function shouldSend($notifiable, string $channel): bool
    {
        // Vérifier si l'utilisateur n'est pas banni
        if ($notifiable->status === 'banned' && $channel === 'mail') {
            return false;
        }

        // Vérifier les préférences de notification de l'utilisateur (si implémenté)
        // if (method_exists($notifiable, 'wantsNotification')) {
        //     return $notifiable->wantsNotification($this->getNotificationType(), $channel);
        // }

        return true;
    }

    /**
     * Récupère le type de notification (pour les préférences)
     */
    abstract protected function getNotificationType(): string;
}
