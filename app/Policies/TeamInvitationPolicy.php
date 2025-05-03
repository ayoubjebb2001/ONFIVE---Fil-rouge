<?php

namespace App\Policies;

use App\Models\TeamInvitation;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TeamInvitationPolicy
{
    public function accept(User $user, TeamInvitation $invitation)
    {
        return $invitation->user_id === $user->id && $invitation->status === 'pending';
    }

    public function decline(User $user, TeamInvitation $invitation)
    {
        return $invitation->user_id === $user->id && $invitation->status === 'pending';
    }
}
