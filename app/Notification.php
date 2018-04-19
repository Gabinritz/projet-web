<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['message', 'user_id', 'unread'];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
