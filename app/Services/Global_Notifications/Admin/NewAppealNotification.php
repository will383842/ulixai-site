<?php

namespace App\Services\Global_Notifications\Admin;

use App\Services\Global_Notifications\BaseNotification;
use App\Services\Global_Moderations\Models\UserAppeal;
use Illuminate\Notifications\Messages\MailMessage;

class NewAppealNotification extends BaseNotification
{
    protected array $defaultChannels = ['database'];

    public function __construct(
        protected UserAppeal $appeal
    ) {}

    public function toMail($notifiable): MailMessage
    {
        $lines = [
            'Un utilisateur a soumis un appel de bannissement.',
            '',
            'Utilisateur : ' . $this->appeal->user->name . ' (#' . $this->appeal->user->id . ')',
            'Numéro d\'appel : ' . $this->appeal->appeal_number,
            '',
            'Raison de l\'appel : ' . substr($this->appeal->reason, 0, 300) . '...',
        ];

        if ($this->appeal->commitment) {
            $lines[] = '';
            $lines[] = 'Engagement : ' . substr($this->appeal->commitment, 0, 200) . '...';
        }

        return $this->buildMailMessage(
            '[Appel] Demande de débannissement',
            $lines,
            'Examiner l\'appel',
            url('/admin/moderation/appeals/' . $this->appeal->id)
        );
    }

    public function toArray($notifiable): array
    {
        return $this->buildDatabaseArray(
            'admin.moderation.new_appeal',
            'Nouvel appel',
            'Appel #' . $this->appeal->appeal_number . ' de ' . $this->appeal->user->name,
            url('/admin/moderation/appeals/' . $this->appeal->id),
            [
                'appeal_id' => $this->appeal->id,
                'user_id' => $this->appeal->user_id,
                'appeal_number' => $this->appeal->appeal_number,
            ]
        );
    }

    protected function getNotificationType(): string
    {
        return 'admin.moderation.new_appeal';
    }
}
