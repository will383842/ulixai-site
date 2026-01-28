<?php

namespace App\Notifications;

use App\Models\Mission;
use App\Services\NotificationService;
use Illuminate\Notifications\Messages\MailMessage;

class MissionCompletedNotification extends BaseNotification
{
    protected string $type = NotificationService::TYPE_MISSION;

    private Mission $mission;
    private bool $isForRequester;

    public function __construct(Mission $mission, bool $isForRequester = true)
    {
        $this->mission = $mission;
        $this->isForRequester = $isForRequester;
    }

    public function toMail($notifiable): MailMessage
    {
        $locale = $this->getUserLocale($notifiable);

        if ($locale === 'fr') {
            if ($this->isForRequester) {
                return (new MailMessage)
                    ->subject('Mission complétée - ' . $this->mission->title)
                    ->greeting('Bonjour ' . $notifiable->name . ',')
                    ->line('Votre mission a été marquée comme complétée.')
                    ->line('**Mission :** ' . $this->mission->title)
                    ->line('')
                    ->line('Le paiement a été libéré au prestataire.')
                    ->line("N'oubliez pas de laisser un avis pour aider la communauté !")
                    ->action('Laisser un avis', url('/dashboard'))
                    ->line('Merci de votre confiance.');
            }

            return (new MailMessage)
                ->subject('Mission complétée - Paiement en cours')
                ->greeting('Félicitations ' . $notifiable->name . ' !')
                ->line('La mission suivante a été marquée comme complétée :')
                ->line('**Mission :** ' . $this->mission->title)
                ->line('')
                ->line('Le paiement sera transféré sur votre compte Stripe.')
                ->action('Voir mes revenus', url('/my-earnings'))
                ->line('Excellent travail !');
        }

        if ($this->isForRequester) {
            return (new MailMessage)
                ->subject('Mission Completed - ' . $this->mission->title)
                ->greeting('Hello ' . $notifiable->name . ',')
                ->line('Your mission has been marked as completed.')
                ->line('**Mission:** ' . $this->mission->title)
                ->line('')
                ->line('The payment has been released to the provider.')
                ->line("Don't forget to leave a review to help the community!")
                ->action('Leave a Review', url('/dashboard'))
                ->line('Thank you for your trust.');
        }

        return (new MailMessage)
            ->subject('Mission Completed - Payment Processing')
            ->greeting('Congratulations ' . $notifiable->name . '!')
            ->line('The following mission has been marked as completed:')
            ->line('**Mission:** ' . $this->mission->title)
            ->line('')
            ->line('The payment will be transferred to your Stripe account.')
            ->action('View My Earnings', url('/my-earnings'))
            ->line('Excellent work!');
    }

    public function toArray($notifiable): array
    {
        return [
            'type' => 'mission_completed',
            'mission_id' => $this->mission->id,
            'mission_title' => $this->mission->title,
            'is_requester' => $this->isForRequester,
            'icon' => 'award',
            'color' => 'success',
            'url' => $this->isForRequester ? '/dashboard' : '/my-earnings',
        ];
    }
}
