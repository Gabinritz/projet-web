<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    protected $fillable = ['user_id', 'product_id', 'quantity'];

/*     public function products() {
        return $this->hasMany('App\Product', 'product_id');
    } */
    
    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }
}
