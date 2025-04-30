<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name',
        'logo',
        'city',
        'wins',
        'losses',
        'draws',
        'user_id'
    ];

    public function captain(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function players(){
        return $this->hasMany(Player::class);
    }
}
