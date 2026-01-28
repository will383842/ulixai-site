<?php

namespace App\Notifications;

use App\Models\Mission;
use App\Services\NotificationService;
use Illuminate\Notifications\Messages\MailMessage;

class MissionMatchNotification extends BaseNotification
{
    protected string $type = NotificationService::TYPE_MISSION;

    private Mission $mission;
    private ?float $matchScore;

    public function __construct(Mission $mission, ?float $matchScore = null)
    {
        $this->mission = $mission;
        $this->matchScore = $matchScore;
    }

    public function toMail($notifiable): MailMessage
    {
        $locale = $this->getUserLocale($notifiable);
        $matchPct = $this->matchScore ? number_format($this->matchScore * 100, 0) . '%' : null;
        $budget = $this->mission->budget_max
            ? number_format($this->mission->budget_max, 0) . ' ' . ($this->mission->budget_currency ?? 'EUR')
            : 'À discuter';

        if ($locale === 'fr') {
            $mail = (new MailMessage)
                ->subject('Nouvelle mission correspondant à votre profil')
                ->greeting('Bonjour ' . $notifiable->name . ',')
                ->line('Une nouvelle mission correspond à vos compétences !');

            if ($matchPct) {
                $mail->line('**Compatibilité :** ' . $matchPct);
            }

            return $mail
                ->line('**Mission :** ' . $this->mission->title)
                ->line('**Budget :** ' . $budget)
                ->line('**Lieu :** ' . ($this->mission->location_city ?? $this->mission->location_country ?? 'À distance'))
                ->line('')
                ->action('Voir la mission', url('/mission/' . $this->mission->id))
                ->line('Ne tardez pas, les meilleures missions partent vite !');
        }

        $mail = (new MailMessage)
            ->subject('New mission matching your profile')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('A new mission matches your skills!');

        if ($matchPct) {
            $mail->line('**Match:** ' . $matchPct);
        }

        return $mail
            ->line('**Mission:** ' . $this->mission->title)
            ->line('**Budget:** ' . $budget)
            ->line('**Location:** ' . ($this->mission->location_city ?? $this->mission->location_country ?? 'Remote'))
            ->line('')
            ->action('View Mission', url('/mission/' . $this->mission->id))
            ->line("Don't wait, the best missions go fast!");
    }

    public function toArray($notifiable): array
    {
        return [
            'type' => 'mission_match',
            'mission_id' => $this->mission->id,
            'mission_title' => $this->mission->title,
            'match_score' => $this->matchScore,
            'budget_max' => $this->mission->budget_max,
            'currency' => $this->mission->budget_currency ?? 'EUR',
            'icon' => 'briefcase',
            'color' => 'primary',
            'url' => '/mission/' . $this->mission->id,
        ];
    }
}
