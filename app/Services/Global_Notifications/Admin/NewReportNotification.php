<?php

namespace App\Services\Global_Notifications\Admin;

use App\Services\Global_Notifications\BaseNotification;
use App\Services\Global_Moderations\Models\ContentReport;
use Illuminate\Notifications\Messages\MailMessage;

class NewReportNotification extends BaseNotification
{
    protected array $defaultChannels = ['database'];

    public function __construct(
        protected ContentReport $report
    ) {}

    public function toMail($notifiable): MailMessage
    {
        $lines = [
            'Un nouveau signalement a été soumis.',
            '',
            'Raison : ' . $this->report->reason_label,
            'Priorité : ' . $this->report->priority_label,
            'Type de contenu : ' . $this->report->reportable_type,
        ];

        if ($this->report->description) {
            $lines[] = '';
            $lines[] = 'Description : ' . substr($this->report->description, 0, 200) . '...';
        }

        return $this->buildMailMessage(
            '[Signalement] ' . ucfirst($this->report->priority) . ' - ' . $this->report->reason_label,
            $lines,
            'Voir les signalements',
            url('/admin/moderation/reports')
        );
    }

    public function toArray($notifiable): array
    {
        return $this->buildDatabaseArray(
            'admin.moderation.new_report',
            'Nouveau signalement',
            $this->report->reason_label . ' - Priorité ' . $this->report->priority_label,
            url('/admin/moderation/reports/' . $this->report->id),
            [
                'report_id' => $this->report->id,
                'reason' => $this->report->reason,
                'priority' => $this->report->priority,
                'reported_user_id' => $this->report->reported_user_id,
            ]
        );
    }

    protected function getNotificationType(): string
    {
        return 'admin.moderation.new_report';
    }
}
