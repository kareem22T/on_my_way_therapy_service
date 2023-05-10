<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $user_id;
    public $guard_type;

    public function __construct($message, $user_id, $guard_type)
    {
        $this->message = $message;
        $this->user_id = $user_id;
        $this->guard_type = $guard_type;
    }

    public function broadcastOn()
    {
        return ['chat-channel_' . $this->user_id . '_' . $this->guard_type];
    }

    public function broadcastAs()
    {
        return 'chat-event';
    }
}
