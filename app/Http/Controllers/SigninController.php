<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use App\User;

class SigninController extends Controller
{
    //post quand un utilisateur se connecte
    public function userSignin(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        //vérification email et mot de passe
        if (Auth::attempt(['email' => $request->input('email'), 
                        'password' => $request->input('password')], $request->has('remember'))) {
            return redirect()->route('index');
        }
        return redirect()->back();

    } 

    //post pour inscription user
    public function userRegister(Request $request) {
        $this->validate($request, [
            'firstname' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        //si email a déja été prit
        if(User::where('email', '=', $request->input('email'))->first()) {
            return view('mailnonavaible', ['email' => $request->input('email')]);
        }
        $user = new User([
            'name' => $request->input('name'),
            'firstname' => $request->input('firstname'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'status' => 0
        ]);
        $user->save();
        return redirect()->route('login');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }
} 