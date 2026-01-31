<?php

namespace App\Services\Global_Notifications\Moderation;

use App\Services\Global_Notifications\BaseNotification;
use Illuminate\Notifications\Messages\MailMessage;

class ContentApprovedNotification extends BaseNotification
{
    public function __construct(
        protected string $contentType,
        protected int $contentId,
        protected string $contentTitle
    ) {}

    public function toMail($notifiable): MailMessage
    {
        return $this->buildMailMessage(
            'Votre contenu a été approuvé',
            [
                'Bonne nouvelle ! Votre ' . $this->getContentTypeLabel() . ' a été vérifié et approuvé.',
                'Il est maintenant visible par tous les utilisateurs.',
            ],
            'Voir mon contenu',
            $this->getContentUrl()
        );
    }

    public function toArray($notifiable): array
    {
        return $this->buildDatabaseArray(
            'moderation.content_approved',
            'Contenu approuvé',
            'Votre ' . $this->getContentTypeLabel() . ' "' . $this->contentTitle . '" a été approuvé.',
            $this->getContentUrl(),
            [
                'content_type' => $this->contentType,
                'content_id' => $this->contentId,
            ]
        );
    }

    protected function getNotificationType(): string
    {
        return 'moderation.content_approved';
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

    protected function getContentUrl(): string
    {
        return match ($this->contentType) {
            'mission' => url("/services/request/{$this->contentId}"),
            default => url('/dashboard'),
        };
    }
}
