<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Auth;

class ShopController extends Controller
{
    public function getIndex() {
        $products = Product::all();
        $bestSellers = Product::orderBy('soldnumber', 'DESC')->take(3)->get();
        $user = Auth::user();
        return view('shop.student.index', ['products' => $products, 'user' => $user, 'bestsellers' => $bestSellers]);
    }

    public function getShoppingCart() {
        $user = Auth::user();
        return view('shop.student.shoppingcart', ['user' => $user]);
    }

    public function addToShoppingCart() {

    }

    public function removeFromShoppingCart() {}

    public function postOrder() {
        $products = Product::all();
        $user = Auth::user();
        return view('shop.student.order', ['products' => $products, 'user' => $user]);
    }

    public function getAdminDelete() {
        return redirect()->route('shop.admin.manage');
    } 

    public function postAdminCreate() {
        return redcirect()->route('shop.student.index');
    }
}
