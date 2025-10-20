<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use App\Models\Conversation;
use App\Models\Message;

class NotifyUser implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    protected $conversation;
    protected $message;
    protected $user;
    protected $sender;
    protected $title;

    public function __construct(Conversation $conversation, Message $message, $user, $sender, $title)
    {
        $this->conversation = $conversation;
        $this->message = $message;
        $this->user = $user;
        $this->sender = $sender;
        $this->title = $title;
    }

   
    public function broadcastOn()
    {
        return new Channel('notify-user-' . $this->user);
    }
    
    public function broadcastWith() {
        return  [
            'title' => "New message from {$this->sender} in conversation {$this->title}",
            'conversation' => $this->conversation,
            'message' => $this->message,
            'user' => $this->sender
        ];
    }





}
