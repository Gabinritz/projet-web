<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;
use Auth;

class ActivitiesController extends Controller
{
    public function getIndex() {
        $user = Auth::user();
        $activities = Activity::all();
        return view('activities.student.index', ['activities' => $activities, 'user' => $user]);
    }

    public function postSignUp() {
        return redirect()->route('activities.student.list');
        //validation et ajout user a evenement
    }

    public function getPast() {
        $user = Auth::user();
        //$activities = Activity::where(); //trouver comment prendre anciennes
        return view('activities.student.past', ['user' => $user]);
    }

    public function getFocus($id) {
        $activity = Activity::find($id);
        $user = Auth::user();
        return view('activities.student.focus', ['id' => $id, 'user' => $user]);
    }

    public function getAdminFocus($id) {
        $user = Auth::user();
        $activity = Activity::find($id);
        return view('activities.admin.focus', ['$id' => 'id', 'user' => $user]);
    }
}
