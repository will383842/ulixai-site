<?php

namespace App\Notifications;

use App\Models\Mission;
use App\Models\MissionOffer;
use App\Services\NotificationService;
use Illuminate\Notifications\Messages\MailMessage;

class OfferAcceptedNotification extends BaseNotification
{
    protected string $type = NotificationService::TYPE_MISSION;

    private Mission $mission;
    private MissionOffer $offer;

    public function __construct(Mission $mission, MissionOffer $offer)
    {
        $this->mission = $mission;
        $this->offer = $offer;
    }

    public function toMail($notifiable): MailMessage
    {
        $locale = $this->getUserLocale($notifiable);
        $amount = number_format($this->offer->price, 2) . ' ' . ($this->offer->currency ?? 'EUR');

        if ($locale === 'fr') {
            return (new MailMessage)
                ->subject('Votre offre a été acceptée !')
                ->greeting('Félicitations ' . $notifiable->name . ' !')
                ->line('Votre offre pour la mission suivante a été acceptée :')
                ->line('**Mission :** ' . $this->mission->title)
                ->line('**Montant :** ' . $amount)
                ->line('')
                ->line('Le demandeur a effectué le paiement. Vous pouvez maintenant commencer le travail.')
                ->action('Voir la mission', url('/dashboard'))
                ->line('Bonne chance pour cette mission !');
        }

        return (new MailMessage)
            ->subject('Your offer has been accepted!')
            ->greeting('Congratulations ' . $notifiable->name . '!')
            ->line('Your offer for the following mission has been accepted:')
            ->line('**Mission:** ' . $this->mission->title)
            ->line('**Amount:** ' . $amount)
            ->line('')
            ->line('The requester has made the payment. You can now start working.')
            ->action('View Mission', url('/dashboard'))
            ->line('Good luck with this mission!');
    }

    public function toArray($notifiable): array
    {
        return [
            'type' => 'offer_accepted',
            'mission_id' => $this->mission->id,
            'mission_title' => $this->mission->title,
            'offer_id' => $this->offer->id,
            'amount' => $this->offer->price,
            'currency' => $this->offer->currency ?? 'EUR',
            'icon' => 'check-circle',
            'color' => 'success',
            'url' => '/dashboard',
        ];
    }
}
