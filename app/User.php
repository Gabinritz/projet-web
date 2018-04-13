<?php

namespace App;

use Illuminate\Notifications\Notifiable;
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
        'name', 'email', 'password', 'status', 'firstname'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function ideas() {
        return $this->hasMany('App\Idea', 'user_id');
    }

    public function votes() {
        return $this->hasMany('App\Vote', 'user_id');
    }

    public function likes() {
        return $this->hasMany('App\Like', 'user_id');
    }

    public function images() {
        return $this->hasMany('App\Image', 'user_id');
    }

    public function comments() {
        return $this->hasMany('App\Comment', 'user_id');
    }

    public function participates() {
        return $this->hasMany('App\Participate', 'user_id');
    }
}
