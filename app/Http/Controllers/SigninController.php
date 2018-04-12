<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use App\User;

class SigninController extends Controller
{
    public function userSignin(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::attempt(['email' => $request->input('email'), 
                        'password' => $request->input('password')], $request->has('remember'))) {
            return redirect()->route('index');
        }
        return redirect()->back();

    } 

    public function userRegister(Request $request) {
        $this->validate($request, [
            'firstname' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(User::where('email', '=', $request->input('email'))->first()) {
            return $request->input('email');
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