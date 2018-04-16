<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = ['name', 'description', 'date', 'place', 'imgUrl', 'price', 'recurrent'];

    public function images() {
        return $this->hasMany('App\Image', 'activity_id');
    }

    public function participates() {
        return $this->hasMany('App\Participate', 'activity_id');
    }
}
