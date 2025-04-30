<?php

namespace App\Http\Controllers;


use App\Models\Team;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('team.create',[
            'user' => auth()->user(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeamRequest $request)
    {
        $validated = $request->validated();
        
        $validated = $request->safe()->only(['name', 'city']);

        $file_name = Str::slug($validated['name']) . '.' . $request->file('logo')->extension();

        if($request->hasFile('logo')) {
            //check if the file already exists in storage
            $existingFile = storage_path('app/teams/' . $file_name);
            // if it exists, don't upload it again
            if (!file_exists($existingFile)) {
                $request->file('logo')->storeAs('teams', $file_name);
            }
        }
        $validated ['logo'] = $file_name;
        $validated['user_id'] = Auth::id();
        $team = Team::create($validated);
        if($team){
            Auth::user()->update([
                'role' => 'captain',
            ]);
            $player = Auth::user()->player;
            $player->team_id = $team->id;
            $player->save();
            $team->players()->save($player);
            return redirect()->route('teams.add-players-form', $team->id)->with('success', 'Team created successfully');
        }else{
            return redirect()->back()->with('error', 'Team creation failed');
        }
    }

    /**
     * Show the form for adding players to the team.
     */
    public function showAddPlayers(Team $team){
        $user = Auth::user()->only(['username','first_name', 'last_name', 'profile_picture', 'role']);
        $players = $team->players()->with('user')->get();
        return view('team.add-players', [
            'user' => $user,
            'team' => $team,
            'players' => $players,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        //
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
