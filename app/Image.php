<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function activity() {
        return $this->belongsTo('App\Activity', 'activity_id');
    }

    public function likes() {
        return $this->hasMany('App\Like', 'image_id');
    }

    public function comments() {
        return $this->hasMany('App\Comment', 'image_id');
    }
}
