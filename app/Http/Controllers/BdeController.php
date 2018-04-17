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

    public function notifyReport() {
        $user = Auth::user();
        //check si salarié cesi
        if(!$user || $user->status != 2) {
            return redirect()->route('login');
        }

        $bdeMembers = User::where('status', 1)->get();

        if($type = 1) {
            $content = 'Le commentaire : COMMENTAIRE de JEAN sur la photo PHOTO doit être supprimé';
        }
        else if($type = 2) {
            $content = 'La photo : PHOTO de JEAN sur l\'activité ACTIVITE doit être supprimée';
        }
        else {
            $content = 'L\'activité ACTIVITE doit etre supprimée';
        }

        foreach($bdeMembers as $member) {
            $notification = new Notification([
                'message' => $content,
                'user_id' => $member->user_id,
                'unread' => true
            ]);
            $notification->save();
        }

        return redirect()->back();
    }

    public function notificationRead($notification) {

        //unread notif

        return redirect()->back();
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
