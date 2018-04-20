<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ShoppingCart;
use Auth;
use Mail;
use App\User;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    //accueil boutique
    public function getIndex() {

        $user = Auth::user();

        if(!$user) {
            return redirect()->route('login');
        }

        //cherche trois produits les plus vendus et tout les produits
        $products = Product::all();
        $bestSellers = Product::orderBy('soldnumber', 'DESC')->take(3)->get();
        $categories = Product::select('category')->distinct()->get();
        $user = Auth::user();

        return view('shop.student.index', ['products' => $products, 'user' => $user, 'bestsellers' => $bestSellers, 'categories' => $categories]);
    }

    //apres filtrage par catégorie
    public function filterProducts(Request $request) {
        $user = Auth::user();

        if(!$user) {
            return redirect()->route('login');
        }

        //cherche trois produits les plus vendus et les produits correspondants a la catégorie
        $products = Product::where('category', $request->input('category'))->get();
        $bestSellers = Product::orderBy('soldnumber', 'DESC')->take(3)->get();
        $categories = Product::select('category')->distinct()->get();
        $user = Auth::user();
        return view('shop.student.index', ['products' => $products, 'user' => $user, 'bestsellers' => $bestSellers, 'categories' => $categories]);
    } 

    //créer produit
    public function addProduct(Request $request) {
        $user = Auth::user();

        if(!$user && $user->status != 1) {
            return redirect()->route('login');
        }

        if ($request->hasFile('image')) {
            $request->file('image');
            $path = Storage::putFile('public', $request->file('image'));
            $path = str_replace('public/', '', $path);
        } else {
            $path = 'background.jpg';
        }


        $product = new Product([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'category' => $request->input('categorie'),
            'stock' => $request->input('stock'),
            'soldnumber' => 0,
            'imgUrl' => $path
            
        ]);
        $product->save();

        return redirect()->back();
    }

    //supprimer produit
    public function deleteProduct(Request $request) {
        $user = Auth::user();

        if(!$user && $user->status != 1) {
            return redirect()->route('login');
        }

        $productId = $request->input('productId');
        $product = Product::find($productId);
        $product->delete();
        $shopppingCarts = ShoppingCart::where('product_id', $productId);
        $shopppingCarts->delete();

        return redirect()->back();

    }

    //acces au panier
    public function getShoppingCart() {
        
        $user = Auth::user();

        if(!$user) {
            return redirect()->route('login');
        }

        //cherche enregistrements pour user correspondant
        $carts = ShoppingCart::where('user_id', $user->id)->get();

        $productsId = [];

        //cherche produit correspondant à enregistrement
        foreach($carts as $cart) {
            array_push($productsId, $cart->product_id);
        }

        $products = Product::whereIn('id', $productsId)->get();
        $totalPrice = 0;

        //calcule prix total du panier pour le renvoyer
        foreach($products as $product) {
            $product->quantity = ShoppingCart::where('product_id', $product->id)->where('user_id', $user->id)->first()->quantity;
            $totalPrice += $product->price * $product->quantity;
        }

        return view('shop.student.shoppingcart', ['user' => $user, 'products' => $products, 'totalPrice' => $totalPrice]);
    }

    //ajouter produit au panier
    public function addToShoppingCart($productId) {
        
        $user = Auth::user();

        if(!$user) {
            return redirect()->route('login');
        }

        $product = Product::find($productId);

        $quantity = ShoppingCart::where('product_id', $productId)->where('user_id', $user->id)->first();
        //si produit déja dans le shopping cart alors quantité ++
        if($quantity) {
            ShoppingCart::where('product_id', $productId)->where('user_id', $user->id)->increment('quantity');
        }
        //si produit pas dans le shopping cart alors on ajoute au panier
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

    //supprimer article du panier
    public function removeFromShoppingCart($productId) 
    {
        $user = Auth::user();

        if(!$user) {
            return redirect()->route('login');
        }

        //si article en un seul exemplaire dans panier, supprime enregistrement
        $quantity = ShoppingCart::where('product_id', $productId)->where('user_id', $user->id)->first();
        if($quantity->quantity == 1) {
            $product = ShoppingCart::where('product_id', $productId)->where('user_id', $user->id);
            $product->delete();
        }
        //si article en plusieurs exemplaire dans panier, quantité --
        else {
            ShoppingCart::where('product_id', $productId)->where('user_id', $user->id)->decrement('quantity');
        }

        return redirect()->back();
    }

    //fonction pour passer commande
    public function getOrder() {
                
        $user = Auth::user();

        if(!$user) {
            return redirect()->route('login');
        }

        //récupère enregistrements produit pour utilisateur
        $carts = ShoppingCart::where('user_id', $user->id)->get();

        $productsId = [];

        foreach($carts as $cart) {
            array_push($productsId, $cart->product_id);
        }

        //récupère produit des enregistrements
        $products = Product::whereIn('id', $productsId)->get();
        $totalPrice = 0;

        //calcul prix total
        foreach($products as $product) {
            $product->quantity = ShoppingCart::where('product_id', $product->id)->where('user_id', $user->id)->first()->quantity;
            $totalPrice += $product->price * $product->quantity;
        }
        //réduit stock et augmente nombre de ventes
        Product::whereIn('id', $productsId)->increment('soldnumber');
        Product::whereIn('id', $productsId)->decrement('stock');

        //envoie mail de confirmation pour acheteur
        define('RECIPIENT',  $user->email);

        Mail::send('mails.neworder', array('products' => $products, 'totalPrice' => $totalPrice, 'Bde' => 0, 'user' => $user), function($message)
        {
            $message->from('bde-exiast@abi-projet.fr', 'BotBDE');
            $message->to(RECIPIENT)->subject('Confirmation Nouvelle Commande');
        });


        //envoie mail de confirmation pour bde
        Mail::send('mails.neworder', array('products' => $products, 'totalPrice' => $totalPrice, 'Bde' => 1, 'user' => $user), function($message)
        {

            $bdemails = [];
            $bdeMembers = User::where('status', 1)->get();
        
            //créer array avec adresse des membres bde
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