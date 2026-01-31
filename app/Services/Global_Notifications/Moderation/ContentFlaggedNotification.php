<?php

namespace App\Services\Global_Notifications\Moderation;

use App\Services\Global_Notifications\BaseNotification;
use App\Services\Global_Moderations\Models\ModerationFlag;
use Illuminate\Notifications\Messages\MailMessage;

class ContentFlaggedNotification extends BaseNotification
{
    protected array $defaultChannels = ['database'];

    public function __construct(
        protected ModerationFlag $flag,
        protected string $contentType
    ) {}

    public function toMail($notifiable): MailMessage
    {
        return $this->buildMailMessage(
            'Votre contenu est en cours de vérification',
            [
                'Nous avons reçu votre publication et elle est actuellement en cours de vérification par notre équipe.',
                'Vous serez notifié dès que la vérification sera terminée.',
                'Ce processus prend généralement moins de 24 heures.',
            ],
            'Voir mes publications',
            url('/dashboard/my-requests')
        );
    }

    public function toArray($notifiable): array
    {
        return $this->buildDatabaseArray(
            'moderation.content_flagged',
            'Contenu en vérification',
            'Votre ' . $this->getContentTypeLabel() . ' est en cours de vérification.',
            null,
            [
                'content_type' => $this->contentType,
                'flag_id' => $this->flag->id,
            ]
        );
    }

    protected function getNotificationType(): string
    {
        return 'moderation.content_flagged';
    }

    protected function getContentTypeLabel(): string
    {
        return match ($this->contentType) {
            'mission' => 'demande de service',
            'offer' => 'proposition',
            'message' => 'message',
            default => 'contenu',
        };
    }
}
