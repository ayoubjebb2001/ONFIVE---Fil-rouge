<?php

namespace App\Listeners;

use App\Events\TeamInvitationSent;
use App\Models\User;
use App\Notifications\TeamInvitationNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class sendTeamInvitaionNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TeamInvitationSent $event): void
    {
        $user = User::find($event->teamInvitation->user_id);

        // Make sure we found a user and that they don't already have this notification
        if ($user) {
            $user->notify(new TeamInvitationNotification($event->teamInvitation));
        }
    }
}
