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

    public function user(){
        return $this->hasOne(User::class);
    }
}
