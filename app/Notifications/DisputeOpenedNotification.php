<?php

namespace App\Notifications;

use App\Models\Mission;
use App\Services\NotificationService;
use Illuminate\Notifications\Messages\MailMessage;

class DisputeOpenedNotification extends BaseNotification
{
    protected string $type = NotificationService::TYPE_DISPUTE;

    private Mission $mission;
    private string $openedBy;
    private string $reason;

    public function __construct(Mission $mission, string $openedBy, string $reason)
    {
        $this->mission = $mission;
        $this->openedBy = $openedBy;
        $this->reason = $reason;
    }

    public function toMail($notifiable): MailMessage
    {
        $locale = $this->getUserLocale($notifiable);
        $isRequester = $notifiable->id === $this->mission->requester_id;

        if ($locale === 'fr') {
            $subject = 'Litige ouvert - Mission #' . $this->mission->id;
            $greeting = 'Bonjour ' . $notifiable->name . ',';

            if ($isRequester) {
                $intro = 'Un litige a été ouvert concernant votre mission.';
            } else {
                $intro = 'Un litige a été ouvert concernant une mission sur laquelle vous travaillez.';
            }

            $lines = [
                '**Mission :** ' . $this->mission->title,
                '**Ouvert par :** ' . ucfirst($this->openedBy),
                '**Raison :** ' . $this->reason,
                '',
                'Notre équipe va examiner ce litige et vous tiendra informé de la résolution.',
            ];
            $actionText = 'Voir le détail';
            $outro = 'Vous pouvez répondre à cet email si vous avez des informations à ajouter.';
        } else {
            $subject = 'Dispute Opened - Mission #' . $this->mission->id;
            $greeting = 'Hello ' . $notifiable->name . ',';

            if ($isRequester) {
                $intro = 'A dispute has been opened regarding your mission.';
            } else {
                $intro = 'A dispute has been opened regarding a mission you are working on.';
            }

            $lines = [
                '**Mission:** ' . $this->mission->title,
                '**Opened by:** ' . ucfirst($this->openedBy),
                '**Reason:** ' . $this->reason,
                '',
                'Our team will review this dispute and keep you informed of the resolution.',
            ];
            $actionText = 'View Details';
            $outro = 'You can reply to this email if you have additional information to provide.';
        }

        $mail = (new MailMessage)
            ->subject($subject)
            ->greeting($greeting)
            ->line($intro);

        foreach ($lines as $line) {
            $mail->line($line);
        }

        return $mail
            ->action($actionText, url('/dashboard'))
            ->line($outro);
    }

    public function toArray($notifiable): array
    {
        return [
            'type' => 'dispute_opened',
            'mission_id' => $this->mission->id,
            'mission_title' => $this->mission->title,
            'opened_by' => $this->openedBy,
            'reason' => $this->reason,
            'icon' => 'alert-triangle',
            'color' => 'warning',
            'url' => '/dashboard',
        ];
    }
}
