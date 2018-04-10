<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function getIndex() {
        return view('shop.student.homepage');
    }

    public function getShoppingCart() {
        return view('shop.student.shoppingcart');
    }

    public function getOrder() {
        return view('shop.student.order');
    }

    public function getAdminManage() {
        return view('shop.admin.manage');
    }

    public function postAdminManage() {
        return redirect()->route('shop.admin.manage');
    } 

    public function getAdminCreate() {
        return view('shop.admin.create');
    }

    public function postAdminCreate() {
        return redcirect()->route('shop.student.homepage');
    }
}
