<?php

namespace App\Services\Global_Notifications\Moderation;

use App\Services\Global_Notifications\BaseNotification;
use Illuminate\Notifications\Messages\MailMessage;

class ContentRejectedNotification extends BaseNotification
{
    public function __construct(
        protected string $contentType,
        protected string $contentTitle,
        protected string $reason,
        protected bool $isStrikeIssued = false
    ) {}

    public function toMail($notifiable): MailMessage
    {
        $lines = [
            'Votre ' . $this->getContentTypeLabel() . ' n\'a pas pu être publié car il ne respecte pas nos conditions d\'utilisation.',
            'Raison : ' . $this->reason,
        ];

        if ($this->isStrikeIssued) {
            $lines[] = '';
            $lines[] = '⚠️ Un avertissement a été ajouté à votre compte. Veuillez respecter nos règles pour éviter une suspension.';
        }

        $lines[] = '';
        $lines[] = 'Si vous pensez qu\'il s\'agit d\'une erreur, vous pouvez nous contacter.';

        return $this->buildMailMessage(
            'Contenu non publié',
            $lines,
            'Consulter les règles',
            url('/terms-of-service')
        );
    }

    public function toArray($notifiable): array
    {
        $message = 'Votre ' . $this->getContentTypeLabel() . ' "' . $this->contentTitle . '" n\'a pas été approuvé.';

        if ($this->isStrikeIssued) {
            $message .= ' Un avertissement a été ajouté à votre compte.';
        }

        return $this->buildDatabaseArray(
            'moderation.content_rejected',
            'Contenu non publié',
            $message,
            url('/terms-of-service'),
            [
                'content_type' => $this->contentType,
                'reason' => $this->reason,
                'strike_issued' => $this->isStrikeIssued,
            ]
        );
    }

    protected function getNotificationType(): string
    {
        return 'moderation.content_rejected';
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
