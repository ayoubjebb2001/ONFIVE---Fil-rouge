<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name',
        'logo',
        'wins',
        'losses',
        'draws',
        'user_id'
    ];

    public function captain(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
