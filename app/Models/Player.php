<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = [
        'position',
        'foot',
        'team_id',
        'user_id'
    ];

    public function team(){
        return $this->belongsTo(Team::class);
    }

    public function captain(){
        return  $this->team()->captain();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
