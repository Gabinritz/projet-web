<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
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

    public function sendEmailOrder() {
 
            Mail::send('mails.neworder', array('nick' => 'onsenfout'), function($message)
        {
            $message->from('bde-exiast@abi-projet.fr', 'BotBDE');
            $message->to('gabinritz@gmail.com')->subject('Nouvelle Commande reçue');
        });
                     
        return redirect()->route('index');
    }
}
