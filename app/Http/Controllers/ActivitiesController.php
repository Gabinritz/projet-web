<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;

class ActivitiesController extends Controller
{
    public function getIndex() {
        $activities = Activity::all();
        return view('activities.student.index', ['activities' => $activities]);
    }

    public function postSignUp() {
        return redirect()->route('activities.student.list');
        //validation et ajout user a evenement
    }

    public function getPast() {
        //$activities = Activity::where(); //trouver comment prendre anciennes
        return view('activities.student.past');
    }

    public function getFocus($id) {
        $activity = Activity::find($id);
        return view('activities.student.focus', ['$id' => 'id']);
    }

    public function getAdminFocus($id) {
        $activity = Activity::find($id);
        return view('activities.admin.focus', ['$id' => 'id']);
    }
}
