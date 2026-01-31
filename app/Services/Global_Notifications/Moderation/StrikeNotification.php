<?php

namespace App\Services\Global_Notifications\Moderation;

use App\Services\Global_Notifications\BaseNotification;
use App\Services\Global_Moderations\Models\UserStrike;
use Illuminate\Notifications\Messages\MailMessage;

class StrikeNotification extends BaseNotification
{
    public function __construct(
        protected UserStrike $strike,
        protected int $totalStrikes,
        protected int $maxStrikes
    ) {}

    public function toMail($notifiable): MailMessage
    {
        $remaining = $this->maxStrikes - $this->totalStrikes;

        $lines = [
            "Vous avez reçu un avertissement ({$this->totalStrikes}/{$this->maxStrikes}).",
            '',
            'Raison : ' . $this->strike->reason_label,
        ];

        if ($this->strike->details) {
            $lines[] = 'Détails : ' . $this->strike->details;
        }

        $lines[] = '';

        if ($remaining > 0) {
            $lines[] = "⚠️ Attention : après {$remaining} avertissement(s) supplémentaire(s), votre compte sera automatiquement suspendu.";
        } else {
            $lines[] = '🚫 Votre compte a été suspendu suite à ce dernier avertissement.';
        }

        $lines[] = '';
        $lines[] = 'Nous vous invitons à consulter nos conditions d\'utilisation pour éviter de futures violations.';

        return $this->buildMailMessage(
            "Avertissement ({$this->totalStrikes}/{$this->maxStrikes})",
            $lines,
            'Conditions d\'utilisation',
            url('/terms-of-service')
        );
    }

    public function toArray($notifiable): array
    {
        $remaining = $this->maxStrikes - $this->totalStrikes;
        $message = "Avertissement {$this->totalStrikes}/{$this->maxStrikes} - " . $this->strike->reason_label;

        if ($remaining === 0) {
            $message .= ' - Compte suspendu';
        }

        return $this->buildDatabaseArray(
            'moderation.strike',
            "Avertissement ({$this->totalStrikes}/{$this->maxStrikes})",
            $message,
            url('/terms-of-service'),
            [
                'strike_id' => $this->strike->id,
                'strike_number' => $this->totalStrikes,
                'max_strikes' => $this->maxStrikes,
                'remaining' => $remaining,
                'reason' => $this->strike->reason,
            ]
        );
    }

    protected function getNotificationType(): string
    {
        return 'moderation.strike';
    }
}
