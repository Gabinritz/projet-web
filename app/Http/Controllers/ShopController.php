<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ShoppingCart;
use Auth;

class ShopController extends Controller
{
    public function getIndex() {

        $user = Auth::user();

        if(!$user) {
            return redirect()->route('login');
        }

        $products = Product::all();
        $bestSellers = Product::orderBy('soldnumber', 'DESC')->take(3)->get();
        $user = Auth::user();
        return view('shop.student.index', ['products' => $products, 'user' => $user, 'bestsellers' => $bestSellers]);
    }

    public function getShoppingCart() {
        $user = Auth::user();

        if(!$user) {
            return redirect()->route('login');
        }

        return view('shop.student.shoppingcart', ['user' => $user]);
    }

    public function addToShoppingCart($productId) {
        $user = Auth::user();

        if(!$user) {
            return redirect()->route('login');
        }
        $product = Product::find($productId);
        $shoppingcart = new ShoppingCart([
            'user_id' => $user->id
        ]);
        $shoppingcart->products()->save($product);

        return redirect()->back();

    }

    public function removeFromShoppingCart() {}

    public function postOrder() {
        $user = Auth::user();

        if(!$user) {
            return redirect()->route('login');
        }
        
        $products = Product::all();
        $user = Auth::user();
        return view('shop.student.order', ['products' => $products, 'user' => $user]);
    }

    public function getAdminDelete() {

        $user = Auth::user();

        if(!$user || $user->status != 1) {
            return redirect()->route('login');
        }

        return redirect()->route('shop.admin.manage');
    } 

    public function postAdminCreate() {

        $user = Auth::user();

        if(!$user || $user->status != 1) {
            return redirect()->route('login');
        }
        return redcirect()->route('shop.student.index');
    }
}
