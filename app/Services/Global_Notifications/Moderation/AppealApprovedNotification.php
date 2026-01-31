<?php

namespace App\Services\Global_Notifications\Moderation;

use App\Services\Global_Notifications\BaseNotification;
use App\Services\Global_Moderations\Models\UserAppeal;
use Illuminate\Notifications\Messages\MailMessage;

class AppealApprovedNotification extends BaseNotification
{
    public function __construct(
        protected UserAppeal $appeal,
        protected ?string $adminNotes = null
    ) {}

    public function toMail($notifiable): MailMessage
    {
        $lines = [
            'Bonne nouvelle ! Votre appel a été examiné et approuvé.',
            '',
            'Votre compte a été réactivé et vous pouvez à nouveau utiliser Ulixai normalement.',
            '',
        ];

        if ($this->appeal->admin_response) {
            $lines[] = 'Message de l\'équipe : ' . $this->appeal->admin_response;
            $lines[] = '';
        }

        $lines[] = 'Nous vous rappelons l\'importance de respecter nos conditions d\'utilisation pour maintenir une communauté de qualité.';

        return $this->buildMailMessage(
            'Appel approuvé - Compte réactivé',
            $lines,
            'Accéder à mon compte',
            url('/dashboard')
        );
    }

    public function toArray($notifiable): array
    {
        return $this->buildDatabaseArray(
            'moderation.appeal_approved',
            'Appel approuvé',
            'Votre appel a été approuvé et votre compte est réactivé.',
            url('/dashboard'),
            [
                'appeal_id' => $this->appeal->id,
                'admin_response' => $this->appeal->admin_response,
            ]
        );
    }

    protected function getNotificationType(): string
    {
        return 'moderation.appeal_approved';
    }
}
