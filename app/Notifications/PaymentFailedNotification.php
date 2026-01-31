<?php

namespace App\Notifications;

use App\Models\Mission;
use App\Services\NotificationService;
use Illuminate\Notifications\Messages\MailMessage;

class PaymentFailedNotification extends BaseNotification
{
    protected string $type = NotificationService::TYPE_PAYMENT;

    private ?Mission $mission;
    private string $reason;
    private ?string $captureId;

    public function __construct(?Mission $mission, string $reason = 'Payment capture failed', ?string $captureId = null)
    {
        $this->mission = $mission;
        $this->reason = $reason;
        $this->captureId = $captureId;
    }

    public function toMail($notifiable): MailMessage
    {
        $locale = $this->getUserLocale($notifiable);

        if ($locale === 'fr') {
            $mail = (new MailMessage)
                ->subject('Échec du paiement')
                ->greeting('Bonjour ' . $notifiable->name . ',')
                ->line('Nous n\'avons pas pu traiter votre paiement.');

            if ($this->mission) {
                $mail->line('**Mission :** ' . $this->mission->title);
            }

            return $mail
                ->line('**Raison :** ' . $this->reason)
                ->line('')
                ->line('Veuillez vérifier votre moyen de paiement et réessayer.')
                ->action('Réessayer le paiement', url('/dashboard'))
                ->line('Si le problème persiste, contactez notre support.');
        }

        $mail = (new MailMessage)
            ->subject('Payment Failed')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('We were unable to process your payment.');

        if ($this->mission) {
            $mail->line('**Mission:** ' . $this->mission->title);
        }

        return $mail
            ->line('**Reason:** ' . $this->reason)
            ->line('')
            ->line('Please check your payment method and try again.')
            ->action('Retry Payment', url('/dashboard'))
            ->line('If the problem persists, please contact our support team.');
    }

    public function toArray($notifiable): array
    {
        return [
            'type' => 'payment_failed',
            'mission_id' => $this->mission?->id,
            'mission_title' => $this->mission?->title,
            'reason' => $this->reason,
            'capture_id' => $this->captureId,
            'icon' => 'x-circle',
            'color' => 'danger',
            'url' => '/dashboard',
        ];
    }
}
