<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JoinRequest extends Model
{
    protected $fillable = [
        'team_id',
        'user_id',
        'status',
    ];

    /**
     * Get the team that received the join request
     */
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    /**
     * Get the player (user) who sent the join request
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
