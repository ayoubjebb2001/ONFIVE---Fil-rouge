<?php

namespace App\Http\Controllers;

use App\Models\TeamInvitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamInvitationController extends Controller
{
    /**
     * Accept a team invitation
     */
    public function accept(TeamInvitation $invitation)
    {
        // Verify user is authorized to accept this invitation
        if ($invitation->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to accept this invitation.'
            ], 403);
        }

        // Verify the invitation is still pending
        if ($invitation->status !== 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'This invitation has already been processed.'
            ], 400);
        }

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
        // Verify user is authorized to decline this invitation
        if ($invitation->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to decline this invitation.'
            ], 403);
        }

        // Verify the invitation is still pending
        if ($invitation->status !== 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'This invitation has already been processed.'
            ], 400);
        }

        // Update invitation status
        $invitation->status = 'declined';
        $invitation->save();

        return response()->json([
            'success' => true,
            'message' => 'You have declined the invitation from ' . $invitation->team->name
        ]);
    }
}
