<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participate extends Model
{
    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function activity() {
        return $this->belongsTo('App\Activity', 'activity_id');
    }
}
