<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MissionMessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $missionId;
    public $requesterId;
    public $messageId;

    public function __construct($missionId, $requesterId, $messageId)
    {
        $this->missionId = $missionId;
        $this->requesterId = $requesterId;
        $this->messageId = $messageId;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('notify-user-' . $this->requesterId);
    }

    public function broadcastAs()
    {
        return 'MissionMessageReceived';
    }

    public function broadcastWith()
    {
        return [
            'mission_id' => $this->missionId,
            'message_id' => $this->messageId,
            'type' => 'public_message'
        ];
    }
}