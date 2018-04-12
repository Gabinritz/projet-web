<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class BdeController extends Controller
{
    public function getIndex() {
        if (!Auth::check()) {
            $user = null;
            return view('welcome', ['user' => $user]);
        }
        $user = Auth::user();
        return view('welcome', ['user' => $user]);
    }

   public function getLogin() {
        return view('login');
   }
}
