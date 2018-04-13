<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['image_id', 'user_id'];

    public function image() {
        return $this->belongsTo('App\Image', 'image_id');
    }

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }
}
