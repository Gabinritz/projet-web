<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ShoppingCart;
use Auth;
use Mail;
use App\User;

class ShopController extends Controller
{
    public function getIndex() {

        $user = Auth::user();

        if(!$user) {
            return redirect()->route('login');
        }

        $products = Product::all();
        $bestSellers = Product::orderBy('soldnumber', 'DESC')->take(3)->get();
        $categories = Product::select('category')->distinct()->get();
        $user = Auth::user();

        return view('shop.student.index', ['products' => $products, 'user' => $user, 'bestsellers' => $bestSellers, 'categories' => $categories]);
    }

    public function filterProducts(Request $request) {
        $user = Auth::user();

        if(!$user) {
            return redirect()->route('login');
        }

        $products = Product::where('category', $request->input('category'))->get();
        $bestSellers = Product::orderBy('soldnumber', 'DESC')->take(3)->get();
        $categories = Product::select('category')->distinct()->get();
        $user = Auth::user();
        return view('shop.student.index', ['products' => $products, 'user' => $user, 'bestsellers' => $bestSellers, 'categories' => $categories]);
    } 

    public function getShoppingCart() {
        
        $user = Auth::user();

        if(!$user) {
            return redirect()->route('login');
        }

        $carts = ShoppingCart::where('user_id', $user->id)->get();

        $productsId = [];

        foreach($carts as $cart) {
            array_push($productsId, $cart->product_id);
        }

        $products = Product::whereIn('id', $productsId)->get();
        $totalPrice = 0;

        foreach($products as $product) {
            $product->quantity = ShoppingCart::where('product_id', $product->id)->where('user_id', $user->id)->first()->quantity;
            $totalPrice += $product->price * $product->quantity;
        }

        return view('shop.student.shoppingcart', ['user' => $user, 'products' => $products, 'totalPrice' => $totalPrice]);
    }

    public function addToShoppingCart($productId) {
        
        $user = Auth::user();

        if(!$user) {
            return redirect()->route('login');
        }

        $product = Product::find($productId);

        $quantity = ShoppingCart::where('product_id', $productId)->where('user_id', $user->id)->first();
        if($quantity) {
            ShoppingCart::where('product_id', $productId)->where('user_id', $user->id)->increment('quantity');
        }
        else {
            $shoppingcart = new ShoppingCart([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 1
            ]);
            $shoppingcart->save();
        }
        


        return redirect()->back();

    }

    public function removeFromShoppingCart($productId) 
    {
        $user = Auth::user();

        if(!$user) {
            return redirect()->route('login');
        }

        $quantity = ShoppingCart::where('product_id', $productId)->where('user_id', $user->id)->first();
        if($quantity->quantity == 1) {
            $product = ShoppingCart::where('product_id', $productId)->where('user_id', $user->id);
            $product->delete();
        }
        else {
            ShoppingCart::where('product_id', $productId)->where('user_id', $user->id)->decrement('quantity');
        }

        return redirect()->back();
    }

    public function getOrder() {
        $user = Auth::user();

        if(!$user) {
            return redirect()->route('login');
        }
        
        $carts = ShoppingCart::where('user_id', $user->id)->get();
        $productsId = [];

        foreach($carts as $cart) {
            array_push($productsId, $cart->product_id);
        }
        ShoppingCart::where('user_id', $user->id)->delete();
        $products = Product::whereIn('id', $productsId)->get();
        Product::whereIn('id', $productsId)->increment('soldnumber');
        $totalPrice = 0;

        foreach($products as $product) {
            $totalPrice += $product->price;
        }
        define('RECIPIENT',  $user->email);

        Mail::send('mails.neworder', array('products' => $products, 'totalPrice' => $totalPrice), function($message)
        {
            $message->from('bde-exiast@abi-projet.fr', 'BotBDE');
            $message->to(RECIPIENT)->subject('Confirmation Nouvelle Commande');
        });

        Mail::send('mails.neworder', array('products' => $products, 'totalPrice' => $totalPrice), function($message)
        {

            $bdemails = [];
            $bdeMembers = User::where('status', 1)->get();
        
            foreach($bdeMembers as $bdemember) {
                $i =0;
                array_push($bdemails, $bdemember->email);
                $i++;
            }

            $message->from('bde-exiast@abi-projet.fr', 'BotBDE');
            $message->to($bdemails)->subject('Confirmation Nouvelle Commande');
        });

        return view('shop.student.order', ['user' => $user]);
    }
}
