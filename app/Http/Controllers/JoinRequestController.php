<?php

namespace App\Http\Controllers;

use App\Events\JoinRequestSent;
use App\Models\JoinRequest;
use App\Models\Team;
use App\Models\User;
use App\Models\Player;
use App\Notifications\JoinRequestNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class JoinRequestController extends Controller
{
    /**
     * Display a listing of join requests for the team.
     */
    public function index(Team $team)
    {
        // Check if the current user is the team captain
        Gate::authorize('view', $team);

        $joinRequests = $team->joinRequests()->with('user')->get();

        return response()->json([
            'status' => 'success',
            'data' => $joinRequests
        ]);
    }

    /**
     * Store a newly created join request.
     */
    public function store(Request $request, Team $team)
    {
        $user = Auth::user();

        // Check if user is already in a team
        if ($user->player && $user->player->team_id) {
            return response()->json([
                'status' => 'error',
                'message' => 'You are already a member of a team.'
            ], 400);
        }

        // Check if a pending join request already exists
        $existingRequest = JoinRequest::where('user_id', $user->id)
            ->where('team_id', $team->id)
            ->where('status', 'pending')
            ->first();

        if ($existingRequest) {
            return response()->json([
                'status' => 'error',
                'message' => 'You have already sent a join request to this team.'
            ], 400);
        }

        // Create the join request
        $joinRequest = JoinRequest::create([
            'team_id' => $team->id,
            'user_id' => $user->id,
            'message' => $request->message ?? null,
            'status' => 'pending',
        ]);

        JoinRequestSent::dispatch($joinRequest);

        return redirect()->back()->with('success', 'Join request sent successfully.');
    }

    /**
     * Accept a join request.
     */
    public function accept(JoinRequest $joinRequest)
    {
        // Check if the user is the team captain
        $team = Team::findOrFail($joinRequest->team_id);
        Gate::authorize('update', $team);

        // Check if the request is still pending
        if ($joinRequest->status !== 'pending') {
            return response()->json([
                'status' => 'error',
                'message' => 'This join request has already been processed.'
            ], 400);
        }

        // Update join request status
        $joinRequest->status = 'accepted';
        $joinRequest->save();

        $user = User::findOrFail($joinRequest->user_id);

        // Check if the user already has a player record
        $player = $user->player;
        if ($player) {
            // Update the player's team
            $player->team_id = $team->id;
            $player->save();
        } else {
            // Create a new player record
            Player::create([
                'user_id' => $user->id,
                'team_id' => $team->id,
                'position' => null, // Default values as needed
                'foot' => null,
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Join request accepted successfully.',
            'data' => $joinRequest
        ]);
    }

    /**
     * Decline a join request.
     */
    public function decline(JoinRequest $joinRequest)
    {
        // Check if the user is the team captain
        $team = Team::findOrFail($joinRequest->team_id);
        $this->authorize('update', $team);

        // Check if the request is still pending
        if ($joinRequest->status !== 'pending') {
            return response()->json([
                'status' => 'error',
                'message' => 'This join request has already been processed.'
            ], 400);
        }

        // Update join request status
        $joinRequest->status = 'declined';
        $joinRequest->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Join request declined successfully.',
            'data' => $joinRequest
        ]);
    }

    /**
     * Get all join requests for the authenticated user.
     */
    public function myRequests()
    {
        $user = Auth::user();
        $joinRequests = $user->joinRequests()->with('team')->get();

        return response()->json([
            'status' => 'success',
            'data' => $joinRequests
        ]);
    }
}
