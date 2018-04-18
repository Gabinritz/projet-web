<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ShoppingCart;
use Auth;
use Mail;

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

        return view('shop.student.shoppingcart', ['user' => $user, 'products' => $products]);
    }

    public function addToShoppingCart($productId) {
        
        $user = Auth::user();

        if(!$user) {
            return redirect()->route('login');
        }

        $product = Product::find($productId);
        
        $shoppingcart = new ShoppingCart([
            'user_id' => $user->id,
            'product_id' => $product->id
        ]);
        $shoppingcart->save();

        return redirect()->back();

    }

    public function removeFromShoppingCart($shoppingCartId) 
    {
        $user = Auth::user();

        if(!$user) {
            return redirect()->route('login');
        }

        $product = ShoppingCart::find($shoppingCartId);
        $product->delete();

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

        Mail::send('mails.neworder', array('nick' => 'onsenfout'), function($message)
        {
            $message->from('bde-exiast@abi-projet.fr', 'BotBDE');
            $message->to(RECIPIENT)->subject('Confirmation Nouvelle Commande');
        });

        $bdemails = [];
        foreach(User::where('status', 1)->email as $email) {
            array_push($bdemails, $email);
        }

        Mail::send('mails.neworder', array('nick' => 'onsenfout'), function($message)
        {
            $message->from('bde-exiast@abi-projet.fr', 'BotBDE');
            $message->to($bdemails)->subject('Confirmation Nouvelle Commande');
        });

        return view('shop.student.order', ['user' => $user]);
    }
}
