<?php

namespace App\Mail;

use App\Models\Mission;
use App\Models\ServiceProvider;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MissionInviteMail extends Mailable
{
    use Queueable, SerializesModels;

    public Mission $mission;
    public ServiceProvider $provider;
    public float $score;

    public function __construct(Mission $mission, ServiceProvider $provider, float $score)
    {
        $this->mission  = $mission;
        $this->provider = $provider;
        $this->score    = $score;
    }

    public function build()
    {
        return $this->subject("New mission match: {$this->mission->title}")
            ->markdown('emails.missions.invite', [
                'providerName' => $this->provider->first_name ?? optional($this->provider->user)->name,
                'matchPct'     => isset($this->score) ? number_format($this->score * 100, 0).'%' : null,
                'mission'     => $this->mission
            ]);
    }
}
