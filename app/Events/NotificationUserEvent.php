<?php

namespace App\Events;

use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NotificationUserEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $message;
    private $user;
    private $rdv;
    private $reservation;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, $message, $rdv, $reservation)
    {
        $this->user = $user;
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
        return new PrivateChannel('notification.user.' . $this->user->id);
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
