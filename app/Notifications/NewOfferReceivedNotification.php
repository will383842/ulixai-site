<?php

namespace App\Notifications;

use App\Models\Mission;
use App\Models\MissionOffer;
use App\Models\ServiceProvider;
use App\Services\NotificationService;
use Illuminate\Notifications\Messages\MailMessage;

class NewOfferReceivedNotification extends BaseNotification
{
    protected string $type = NotificationService::TYPE_MISSION;

    private Mission $mission;
    private MissionOffer $offer;
    private ServiceProvider $provider;

    public function __construct(Mission $mission, MissionOffer $offer, ServiceProvider $provider)
    {
        $this->mission = $mission;
        $this->offer = $offer;
        $this->provider = $provider;
    }

    public function toMail($notifiable): MailMessage
    {
        $locale = $this->getUserLocale($notifiable);
        $amount = number_format($this->offer->price, 2) . ' ' . ($this->offer->currency ?? 'EUR');
        $providerName = $this->provider->first_name ?? optional($this->provider->user)->name ?? 'Un prestataire';

        if ($locale === 'fr') {
            return (new MailMessage)
                ->subject('Nouvelle offre reçue - ' . $this->mission->title)
                ->greeting('Bonjour ' . $notifiable->name . ',')
                ->line('Vous avez reçu une nouvelle offre pour votre mission :')
                ->line('**Mission :** ' . $this->mission->title)
                ->line('**Prestataire :** ' . $providerName)
                ->line('**Montant proposé :** ' . $amount)
                ->line('**Délai :** ' . ($this->offer->delivery_time ?? 'Non précisé'))
                ->line('')
                ->action('Voir les offres', url('/my-service-request/' . $this->mission->id))
                ->line('Consultez le profil du prestataire pour prendre votre décision.');
        }

        return (new MailMessage)
            ->subject('New Offer Received - ' . $this->mission->title)
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('You have received a new offer for your mission:')
            ->line('**Mission:** ' . $this->mission->title)
            ->line('**Provider:** ' . $providerName)
            ->line('**Proposed amount:** ' . $amount)
            ->line('**Delivery time:** ' . ($this->offer->delivery_time ?? 'Not specified'))
            ->line('')
            ->action('View Offers', url('/my-service-request/' . $this->mission->id))
            ->line("Check the provider's profile to make your decision.");
    }

    public function toArray($notifiable): array
    {
        return [
            'type' => 'new_offer_received',
            'mission_id' => $this->mission->id,
            'mission_title' => $this->mission->title,
            'offer_id' => $this->offer->id,
            'provider_id' => $this->provider->id,
            'provider_name' => $this->provider->first_name ?? optional($this->provider->user)->name,
            'amount' => $this->offer->price,
            'currency' => $this->offer->currency ?? 'EUR',
            'icon' => 'file-text',
            'color' => 'primary',
            'url' => '/my-service-request/' . $this->mission->id,
        ];
    }
}
