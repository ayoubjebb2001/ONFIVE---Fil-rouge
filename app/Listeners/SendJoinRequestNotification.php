<?php

namespace App\Listeners;

use App\Events\JoinRequestSent;
use App\Notifications\JoinRequestNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendJoinRequestNotification implements ShouldQueue
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
    public function handle(JoinRequestSent $event): void
    {
        // Get the team captain and send a notification
        $team = $event->joinRequest->team;
        $captain = $team->captain;

        if ($captain) {
            $captain->notify(new JoinRequestNotification($event->joinRequest));
        }
    }
}
