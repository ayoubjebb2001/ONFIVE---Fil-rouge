<?php

namespace App\Http\Controllers;

use App\Models\TeamInvitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TeamInvitationController extends Controller
{
    /**
     * Accept a team invitation
     */
    public function accept(TeamInvitation $invitation)
    {
        // Verify user is authorized to accept this invitation
        Gate::authorize('accept', $invitation);

        // Update invitation status
        $invitation->status = 'accepted';
        $invitation->save();

        // Update the player's team_id
        $player = Auth::user()->player;

        if ($player) {
            $player->team_id = $invitation->team_id;
            $player->save();

            return response()->json([
                'success' => true,
                'message' => 'You have joined ' . $invitation->team->name . ' team!'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Player profile not found.'
        ], 404);
    }

    /**
     * Decline a team invitation
     */
    public function decline(TeamInvitation $invitation)
    {
        Gate::authorize('decline', $invitation);

        // Update invitation status
        $invitation->status = 'declined';
        $invitation->save();

        return response()->json([
            'success' => true,
            'message' => 'You have declined the invitation from ' . $invitation->team->name
        ]);
    }
}
