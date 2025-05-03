<?php

namespace App\Notifications;

use App\Models\TeamInvitation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TeamInvitationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public TeamInvitation $teamInvitation)
    {
        //
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
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'team_invitation_id' => $this->teamInvitation->id,
            'team_id' => $this->teamInvitation->team_id,
            'team_name' => $this->teamInvitation->team->name,
            'team_logo' => $this->teamInvitation->team->logo,
            'type' => $this->teamInvitation->type,
            'message' => "You've been invited to join {$this->teamInvitation->team->name}",
        ];
    }

    /**
     * Get the broadcastable representation of the notification.
     */
    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'id' => $this->id,
            'team_invitation_id' => $this->teamInvitation->id,
            'team_id' => $this->teamInvitation->team_id,
            'team_name' => $this->teamInvitation->team->name,
            'team_logo' => $this->teamInvitation->team->logo,
            'type' => $this->teamInvitation->type,
            'message' => "You've been invited to join {$this->teamInvitation->team->name}",
            'created_at' => now()->diffForHumans(),
        ]);
    }
}
