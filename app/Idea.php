<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    protected $fillable = ['name', 'description', 'place', 'user_id'];

    public function votes() {
        return $this->hasMany('App\Vote');
    }

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }
}
