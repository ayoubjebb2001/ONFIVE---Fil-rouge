<?php

namespace App\Events;

use App\Models\JoinRequest;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class JoinRequestSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The join request instance.
     *
     * @var \App\Models\JoinRequest
     */
    public $joinRequest;

    /**
     * Create a new event instance.
     */
    public function __construct(JoinRequest $joinRequest)
    {
        $this->joinRequest = $joinRequest;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('team.' . $this->joinRequest->team_id),
        ];
    }

}
