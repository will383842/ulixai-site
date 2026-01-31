<?php

namespace App\Services\Global_Notifications\Admin;

use App\Services\Global_Notifications\BaseNotification;
use App\Services\Global_Moderations\Models\ModerationFlag;
use Illuminate\Notifications\Messages\MailMessage;

class NewContentToReviewNotification extends BaseNotification
{
    protected array $defaultChannels = ['database'];

    public function __construct(
        protected ModerationFlag $flag
    ) {}

    public function toMail($notifiable): MailMessage
    {
        return $this->buildMailMessage(
            '[Modération] Nouveau contenu à vérifier',
            [
                'Un nouveau contenu nécessite une vérification manuelle.',
                '',
                'Type : ' . $this->flag->flaggable_type,
                'Score de risque : ' . $this->flag->score . '/100',
                'Problèmes détectés : ' . $this->flag->issues_summary,
            ],
            'Voir la queue de modération',
            url('/admin/moderation/queue')
        );
    }

    public function toArray($notifiable): array
    {
        return $this->buildDatabaseArray(
            'admin.moderation.new_content',
            'Contenu à vérifier',
            "Nouveau contenu en attente (Score: {$this->flag->score})",
            url('/admin/moderation/queue'),
            [
                'flag_id' => $this->flag->id,
                'score' => $this->flag->score,
                'severity' => $this->flag->severity,
                'user_id' => $this->flag->user_id,
            ]
        );
    }

    protected function getNotificationType(): string
    {
        return 'admin.moderation.new_content';
    }
}
