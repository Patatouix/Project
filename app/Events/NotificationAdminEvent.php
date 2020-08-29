<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NotificationAdminEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $message;
    private $rdv;
    private $reservation;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message, $rdv, $reservation)
    {
        $this->message = $message;
        $this->rdv = $rdv;
        $this->reservation = $reservation;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\PrivateChannel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('notification.admin');
    }

    public function broadcastWith()
    {
        return [
            'message' => $this->message,
            'rdv' => $this->rdv,
            'reservation' => $this->reservation
        ];
    }
}
