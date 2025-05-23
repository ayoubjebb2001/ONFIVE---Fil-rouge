<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Http\Requests\StorePlayerRequest;
use App\Http\Requests\UpdatePlayerRequest;
use App\Models\User;
use GuzzleHttp\Psr7\Request;

class PlayerControlller extends Controller
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
        return view('player.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlayerRequest $request)
    {
        $data = $request->validated();
        $player = Player::create([
            'position' => $data['position'],
            'foot' => $data['foot'],
            'user_id' => request()->user()->id,
        ]);
        $player->save();
        if($player) {
            User::where('id', request()->user()->id)->update(['role' => 'player']);
            return redirect()->intended('/')->with('info','You are now a player , you can now join a team');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Player $player)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Player $player)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlayerRequest $request, Player $player)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Player $player)
    {
        //
    }

    /**
     * Search for players.
     */
    public function search(Request $request){
        $query = $request->getHeaders()['query'][0] ?? null;
        dd($query);
        $players = Player::whereHas('user', function($q) use ($query){
            $q->where('first_name', 'LIKE', "%{$query}%")
              ->orWhere('last_name', 'LIKE', "%{$query}%")
              ->orWhere('username', 'LIKE', "%{$query}%");
        })->with('user')->get();

        return response()->json([
            'players' => $players,
        ]);
    }
}
