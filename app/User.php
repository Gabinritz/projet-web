<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['name', 'firstname', 'mail', 'password'];

    public function votes() {
        return $this->hasMany('App\Vote', 'user_id');
    }

    public function likes() {
        return $this->hasMany('App\Like', 'user_id');
    }

    public function comments() {
        return $this->hasMany('App\Comment', 'user_id');
    }

    public function participates() {
        return $this->hasMany('App\Participate', 'user_id');
    }
} 