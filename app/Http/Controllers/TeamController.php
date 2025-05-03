<?php

namespace App\Http\Controllers;


use App\Events\TeamInvitationSent;
use App\Models\Player;
use App\Models\Team;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Models\TeamInvitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $teams = Team::when($search, function ($query) use ($search) {
            return $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('city', 'LIKE', "%{$search}%");
        })
            ->orderBy('wins', 'desc')
            ->paginate(12);

        return view('team.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('team.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeamRequest $request)
    {
        $validated = $request->validated();

        $validated = $request->safe()->only(['name', 'city']);

        $file_name = Str::slug($validated['name']) . '.' . $request->file('logo')->extension();

        if ($request->hasFile('logo')) {
            //check if the file already exists in storage
            $existingFile = storage_path('app/teams/' . $file_name);
            // if it exists, don't upload it again
            if (!file_exists($existingFile)) {
                $request->file('logo')->storeAs('teams', $file_name);
            }
        }
        $validated['logo'] = $file_name;
        $validated['user_id'] = Auth::id();
        $team = Team::create($validated);
        if ($team) {
            Auth::user()->update([
                'role' => 'captain',
            ]);
            $player = Auth::user()->player;
            $player->team_id = $team->id;
            $player->save();
            $team->players()->save($player);
            return redirect()->route('teams.add-players-form', $team->id)->with('success', 'Team created successfully');
        } else {
            return redirect()->back()->with('error', 'Team creation failed');
        }
    }


    /**
     * Show the form for inviting players to the team.
     */
    public function showAddPlayers(Team $team, Request $request)
    {
        Gate::authorize('addPlayers', $team);
        $teamPlayers = $team->players()->with('user')->get();

        // Get search term if provided
        $search = $request->query('search');

        // Number of players per position to show
        $perPage = 10;

        $invitedPlayersIds = TeamInvitation::where('team_id', $team->id)
            ->where('status', 'pending')
            ->pluck('user_id');

        // Base query for free players
        $baseQuery = Player::whereNull('team_id')
            ->whereNotIn('user_id', $invitedPlayersIds)
            ->when($search, function ($query) use ($search) {
                return $query->whereHas('user', function ($q) use ($search) {
                    $q->where('first_name', 'LIKE', "%{$search}%")
                        ->orWhere('last_name', 'LIKE', "%{$search}%");
                });
            })
            ->with([
                'user' => function ($query) {
                    $query->select('id', 'first_name', 'last_name', 'profile_picture', 'birth_date');
                }
            ]);

        // Query players by position with pagination
        $forwards = (clone $baseQuery)
            ->where('position', 'striker')
            ->paginate($perPage, ['*'], 'forwards_page')
            ->through(function ($player) {
                return $this->formatPlayerData($player);
            });

        $midfielders = (clone $baseQuery)
            ->where('position', 'midfielder')
            ->paginate($perPage, ['*'], 'midfielders_page')
            ->through(function ($player) {
                return $this->formatPlayerData($player);
            });

        $defenders = (clone $baseQuery)
            ->where('position', 'defender')
            ->paginate($perPage, ['*'], 'defenders_page')
            ->through(function ($player) {
                return $this->formatPlayerData($player);
            });

        $goalkeepers = (clone $baseQuery)
            ->where('position', 'goalkeeper')
            ->paginate($perPage, ['*'], 'goalkeepers_page')
            ->through(function ($player) {
                return $this->formatPlayerData($player);
            });

        // Get any pending invitations
        $invitedPlayers = TeamInvitation::where('team_id', $team->id)
            ->where('status', 'pending')
            ->with('user:id,first_name,last_name,profile_picture')
            ->get()
            ->map(function ($invitation) {
                return [
                    'id' => $invitation->user->id,
                    'name' => $invitation->user->first_name . ' ' . $invitation->user->last_name,
                    'avatar' => $invitation->user->profile_picture,
                    'invitation_id' => $invitation->id
                ];
            });

        return view('team.add-players', [
            'team' => $team,
            'players' => $teamPlayers,
            'forwards' => $forwards,
            'midfielders' => $midfielders,
            'defenders' => $defenders,
            'goalkeepers' => $goalkeepers,
            'invitedPlayers' => $invitedPlayers,
            'search' => $search
        ]);
    }

    /**
     * Format player data for frontend display
     */
    private function formatPlayerData($player)
    {
        // Calculate age from birthdate
        $birthDate = \Carbon\Carbon::parse($player->user->birth_date);
        $age = $birthDate->age;

        return [
            'id' => $player->id,
            'name' => $player->user->first_name . ' ' . $player->user->last_name,
            'avatar' => $player->user->profile_picture,
            'position' => $player->position,
            'foot' => $player->foot,
            'age' => $age,
        ];
    }

    /**
     * Invite a player to the team.
     */
    public function InvitePlayer(Team $team, Player $player)
    {
        Gate::authorize('invitePlayer', $team);
        // Check if the player is already in a team
        if ($player->team_id) {
            return redirect()->back()->with('error', 'Player is already in a team');
        }

        // Check if the player has already been invited
        $existingInvitation = TeamInvitation::where('team_id', $team->id)
            ->where('user_id', $player->user_id)
            ->where('status', 'pending')
            ->first();

        if ($existingInvitation) {
            return redirect()->back()->with('error', 'Player has already been invited');
        }

        // Create the invitation
        $invitation = new TeamInvitation([
            'type' => 'team_to_player',
            'team_id' => $team->id,
            'user_id' => $player->user_id,
            'status' => 'pending',
        ]);

        $invitation->save();

        event(new TeamInvitationSent($invitation));

        return redirect()->back()->with('success', 'Player invited successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        $team->load(['players.user', 'captain']);
        return view('team.show', compact('team'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeamRequest $request, Team $team)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        //
    }
}
