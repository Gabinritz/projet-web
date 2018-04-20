<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'description', 'category', 'stock', 'soldnumber', 'imgUrl'];

/*     public function shoppingcart() {
        return $this->belongsTo('App\ShoppingCart', 'product_id');
    } */
} 
