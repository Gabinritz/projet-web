<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use User;
use Mail;

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
