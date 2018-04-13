<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = ['name', 'price', 'description', 'category', 'stock', 'soldNumber', 'imgUrl'];

    public function shoppingcarts() {
        return $this->belongsToMany('App\ShoppingCart');
    }
} 
