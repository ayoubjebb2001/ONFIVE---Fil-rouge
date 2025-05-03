<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class TeamInvitation extends Model
{
    protected $fillable = [
        'type',
        'team_id',
        'user_id',
        'status',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class,'team_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
