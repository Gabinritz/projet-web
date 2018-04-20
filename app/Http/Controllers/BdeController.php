<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use User;
use Mail;

class BdeController extends Controller
{
    //page d'accueil du site
    public function getIndex() {
        if (!Auth::check()) {
            $user = null;
            return view('welcome', ['user' => $user]);
        }
        $user = Auth::user();
        return view('welcome', ['user' => $user]);
    }
    //page de login
    public function getLogin() {
        return view('login');
    }

    //Passe une notif de non-lue a lue
    public function notificationRead($notificationId) {

        if (!Auth::check()) {
            $user = null;
            return view('welcome', ['user' => $user]);
        }
        $user = Auth::user();
        
        $notification = Notification::find($notificationId);
        $notification->unread = false;
        $notification->save();

        return redirect()->back();
    }


}
