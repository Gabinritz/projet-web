<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    protected $fillable = ['quantity', 'user_id', 'product_id'];

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function products() {
        return $this->hasMany('App\P roduct', 'product_id');
    }
}
