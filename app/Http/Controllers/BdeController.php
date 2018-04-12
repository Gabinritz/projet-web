<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BdeController extends Controller
{
    public function getIndex() {
        return view('welcome');
    }

    public function getLogin() {
        return view('login');
    }

    public function postLogin() {
        return redirect()->route('welcome');
        //validation
    }
}
