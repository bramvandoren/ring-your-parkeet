<?php

namespace App\Models;

use App\UserGroup;
use App\UserStatus;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends \TCG\Voyager\Models\User
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = ['firstname', 'lastname', 'email'];


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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function isAdmin()
    {
        $adminRole = Role::where('name', 'admin')->first();
        return $this->role_id === $adminRole->id;
    }
    public function isMember()
    {
        $memberRole = Role::where('name', 'member')->first();
        return $this->role_id === $memberRole->id;
    }

    public function userGroup()
    {
        return $this->belongsTo(UserGroup::class, 'group_id');
    }

    public function userStatus()
    {
        return $this->hasOne(UserStatus::class, 'user_id');
    }


}
