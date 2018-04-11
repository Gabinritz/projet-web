<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function getIndex() {
        return view('shop.student.homepage');
        //récupérer produits
    }

    public function getShoppingCart() {
        return view('shop.student.shoppingcart');
        //récupérer le panier
    }

    public function getOrder() {
        return view('shop.student.order');
        //récupérer panier pour commander
    }

    public function getAdminManage() {
        return view('shop.admin.manage');
        //récupérer produits et manager
    }

    public function postAdminManage() {
        return redirect()->route('shop.admin.manage');
        //validation manageent
    } 

    public function getAdminCreate() {
        return view('shop.admin.create');
    }

    public function postAdminCreate() {
        return redcirect()->route('shop.student.homepage');
        //validation et faire produit
    }
}
