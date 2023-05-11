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
    // public $user_id;
    // public $guard_type;

    public function __construct($message)
    {
        $this->message = $message;
        // $this->user_id = $user_id;
        // $this->guard_type = $guard_type;
    }

    public function broadcastOn()
    {
        return ['notification-channel'];
    }

    public function broadcastAs()
    {
        return 'notification-event';
    }
}
