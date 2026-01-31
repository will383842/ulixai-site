<?php

namespace App\Services\Global_Notifications\Moderation;

use App\Services\Global_Notifications\BaseNotification;
use App\Services\Global_Moderations\Models\UserAppeal;
use Illuminate\Notifications\Messages\MailMessage;

class AppealRejectedNotification extends BaseNotification
{
    public function __construct(
        protected UserAppeal $appeal,
        protected bool $canAppealAgain,
        protected int $remainingAppeals
    ) {}

    public function toMail($notifiable): MailMessage
    {
        $lines = [
            'Votre appel a été examiné par notre équipe.',
            '',
            'Après analyse, nous ne sommes pas en mesure de réactiver votre compte.',
            '',
        ];

        if ($this->appeal->admin_response) {
            $lines[] = 'Explication : ' . $this->appeal->admin_response;
            $lines[] = '';
        }

        if ($this->canAppealAgain) {
            $lines[] = "Vous pouvez soumettre un nouvel appel ({$this->remainingAppeals} restant(s)).";
        } else {
            $lines[] = 'Cette décision est définitive. Vous avez épuisé vos possibilités d\'appel.';
        }

        return $this->buildMailMessage(
            'Appel rejeté',
            $lines
        );
    }

    public function toArray($notifiable): array
    {
        $message = 'Votre appel n\'a pas été approuvé.';

        if ($this->canAppealAgain) {
            $message .= " Vous pouvez faire un nouvel appel ({$this->remainingAppeals} restant(s)).";
        } else {
            $message .= ' Décision définitive.';
        }

        return $this->buildDatabaseArray(
            'moderation.appeal_rejected',
            'Appel rejeté',
            $message,
            $this->canAppealAgain ? url('/appeal') : null,
            [
                'appeal_id' => $this->appeal->id,
                'can_appeal_again' => $this->canAppealAgain,
                'remaining_appeals' => $this->remainingAppeals,
                'admin_response' => $this->appeal->admin_response,
            ]
        );
    }

    protected function getNotificationType(): string
    {
        return 'moderation.appeal_rejected';
    }
}
