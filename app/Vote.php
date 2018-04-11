<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    public function idea() {
        return $this->belongsTo('App\Idea', 'idea_id');
    }

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }
}
