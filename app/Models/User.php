<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'birth_date',
        'profile_picture',
        'role',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'birth_date' => 'datetime:d-m-Y',
        ];
    }

    /**
     * Get the player associated with the user.
     */
    public function player()
    {
        return $this->hasOne(Player::class, 'user_id');
    }

    /**
     * Get the team invitations for the user.
     */
    public function invitations()
    {
        return $this->hasMany(TeamInvitation::class, 'user_id');
    }

    /**
     * Get the join requests sent by the user.
     */
    public function joinRequests()
    {
        return $this->hasMany(JoinRequest::class, 'user_id');
    }

}
