<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Auth;

class ShopController extends Controller
{
    public function getIndex() {
        $products = Product::all();
        $user = Auth::user();
        return view('shop.student.index', ['products' => $products, 'user' => $user]);
    }

    public function getShoppingCart() {
        $user = Auth::user();
        return view('shop.student.shoppingcart', ['user' => $user]);
        //récupérer le panier
    }

    public function getOrder() {
        $products = Product::all();
        $user = Auth::user();
        return view('shop.student.order', ['products' => $products, 'user' => $user]);
    }

    public function getAdminManage() {
        $user = Auth::user();
        return view('shop.admin.manage', ['user' => $user]);
        //récupérer produits et manager
    }

    public function postAdminManage() {
        return redirect()->route('shop.admin.manage');
        //validation manageent
    } 

    public function getAdminCreate() {
        $user = Auth::user();
        return view('shop.admin.create', ['user' => $user]);
    }

    public function postAdminCreate() {
        return redcirect()->route('shop.student.index');
        //validation et faire produit
    }
}
