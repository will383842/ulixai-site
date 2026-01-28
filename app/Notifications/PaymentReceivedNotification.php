<?php

namespace App\Notifications;

use App\Models\Mission;
use App\Services\NotificationService;
use Illuminate\Notifications\Messages\MailMessage;

class PaymentReceivedNotification extends BaseNotification
{
    protected string $type = NotificationService::TYPE_PAYMENT;

    private Mission $mission;
    private float $amount;
    private string $currency;

    public function __construct(Mission $mission, float $amount, string $currency = 'EUR')
    {
        $this->mission = $mission;
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function toMail($notifiable): MailMessage
    {
        $locale = $this->getUserLocale($notifiable);
        $amountFormatted = number_format($this->amount, 2) . ' ' . $this->currency;

        if ($locale === 'fr') {
            return (new MailMessage)
                ->subject('Paiement reçu - ' . $amountFormatted)
                ->greeting('Bonjour ' . $notifiable->name . ',')
                ->line('Vous avez reçu un paiement pour une mission complétée.')
                ->line('**Mission :** ' . $this->mission->title)
                ->line('**Montant :** ' . $amountFormatted)
                ->line('')
                ->line('Le montant a été transféré sur votre compte Stripe.')
                ->action('Voir mes revenus', url('/my-earnings'))
                ->line('Merci de votre excellent travail !');
        }

        return (new MailMessage)
            ->subject('Payment Received - ' . $amountFormatted)
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('You have received a payment for a completed mission.')
            ->line('**Mission:** ' . $this->mission->title)
            ->line('**Amount:** ' . $amountFormatted)
            ->line('')
            ->line('The amount has been transferred to your Stripe account.')
            ->action('View My Earnings', url('/my-earnings'))
            ->line('Thank you for your excellent work!');
    }

    public function toArray($notifiable): array
    {
        return [
            'type' => 'payment_received',
            'mission_id' => $this->mission->id,
            'mission_title' => $this->mission->title,
            'amount' => $this->amount,
            'currency' => $this->currency,
            'icon' => 'dollar-sign',
            'color' => 'success',
            'url' => '/my-earnings',
        ];
    }
}
