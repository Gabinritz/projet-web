<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    protected $fillable = ['name', 'description'];

    public function votes() {
        return $this->hasMany('App\Vote');
    }
}
