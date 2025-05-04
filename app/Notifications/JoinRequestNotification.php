<?php

namespace App\Notifications;

use App\Models\JoinRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;

use Illuminate\Notifications\Notification;

class JoinRequestNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * The join request instance.
     *
     * @var \App\Models\JoinRequest
     */
    protected $joinRequest;

    /**
     * Create a new notification instance.
     */
    public function __construct(JoinRequest $joinRequest)
    {
        $this->joinRequest = $joinRequest;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the broadcastable representation of the notification.
     */
    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        $playerName = $this->joinRequest->user->first_name . ' ' . $this->joinRequest->user->last_name;
        $message = "{$playerName} has requested to join {$this->joinRequest->team->name}";

        return new BroadcastMessage([
            'id' => $this->joinRequest->id,
            'type' => 'join_request',
            'user_id' => $this->joinRequest->user_id,
            'user_name' => $playerName,
            'user_profile_picture' => $this->joinRequest->user->profile_picture,
            'team_id' => $this->joinRequest->team_id,
            'team_name' => $this->joinRequest->team->name,
            'message' => $message,
            'created_at' => now()->diffForHumans(),
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $playerName = $this->joinRequest->user->first_name . ' ' . $this->joinRequest->user->last_name;
        $message = "{$playerName} has requested to join {$this->joinRequest->team->name}";

        return [
            'id' => $this->joinRequest->id,
            'type' => 'join_request',
            'user_id' => $this->joinRequest->user_id,
            'user_name' => $playerName,
            'user_profile_picture' => $this->joinRequest->user->profile_picture,
            'team_id' => $this->joinRequest->team_id,
            'team_name' => $this->joinRequest->team->name,
            'message' => $message,
            'created_at' => $this->joinRequest->created_at->diffForHumans(),
        ];
    }
}
