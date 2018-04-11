<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{   
    protected $fillable = ['idea_id', 'user_id'];

    public function idea() {
        return $this->belongsTo('App\Idea', 'idea_id');
    }

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }
}
