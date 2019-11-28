<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'register_datetime'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function user_type()
    {
        return $this->belongsTo(User_type::class, 'user_type_id');
    }
    public function isRole($user_type_id)
    {
        $type = User_type::find($user_type_id);
        return $type->name;
    }
    public function socialAccounts()
    {
        return $this->hasMany(SocialAccount::class);
    }
    public function userBank()
    {
        return $this->hasOne(User_bank::class);
    }
}
