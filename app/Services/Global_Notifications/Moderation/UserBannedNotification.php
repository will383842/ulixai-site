<?php

namespace App\Services\Global_Notifications\Moderation;

use App\Services\Global_Notifications\BaseNotification;
use Illuminate\Notifications\Messages\MailMessage;
use Carbon\Carbon;

class UserBannedNotification extends BaseNotification
{
    public function __construct(
        protected string $reason,
        protected bool $canAppeal,
        protected ?Carbon $appealUntil = null
    ) {}

    public function toMail($notifiable): MailMessage
    {
        $lines = [
            'Votre compte Ulixai a été suspendu.',
            '',
            'Raison : ' . $this->reason,
            '',
        ];

        if ($this->canAppeal && $this->appealUntil) {
            $lines[] = 'Vous avez la possibilité de faire appel de cette décision.';
            $lines[] = 'Date limite pour faire appel : ' . $this->appealUntil->format('d/m/Y à H:i');
            $lines[] = '';

            return $this->buildMailMessage(
                'Compte suspendu',
                $lines,
                'Faire appel',
                url('/appeal')
            );
        }

        $lines[] = 'Cette décision est définitive et ne peut pas faire l\'objet d\'un appel.';

        return $this->buildMailMessage(
            'Compte suspendu définitivement',
            $lines
        );
    }

    public function toArray($notifiable): array
    {
        $message = 'Votre compte a été suspendu. Raison : ' . $this->reason;

        if ($this->canAppeal) {
            $message .= ' Vous pouvez faire appel.';
        }

        return $this->buildDatabaseArray(
            'moderation.user_banned',
            'Compte suspendu',
            $message,
            $this->canAppeal ? url('/appeal') : null,
            [
                'reason' => $this->reason,
                'can_appeal' => $this->canAppeal,
                'appeal_until' => $this->appealUntil?->toISOString(),
            ]
        );
    }

    protected function getNotificationType(): string
    {
        return 'moderation.user_banned';
    }
}
