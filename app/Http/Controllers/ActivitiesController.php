<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;
use App\Participate;
use Auth;

class ActivitiesController extends Controller
{
    public function getIndex() {
        $user = Auth::user();
        $activities = Activity::where('date', '>=', date('Y-m-d'))->take(20)->get();
        return view('activities.student.index', ['activities' => $activities, 'user' => $user]);
    }

    public function postSignUp(Request $request) {
        $user =  Auth::user();
        $activity = Activity::where('id', $request->input('acitvity_id'))->first();
        $participation = new Participate([
            'user_id' => $user->id
        ]);
        return redirect()->route('activities.index');
    }

    public function getPast() {
        $user = Auth::user();
        $activities = Activity::where('date', '<=', date('Y-m-d'))->take(20)->get();
        return view('activities.student.past', ['user' => $user]);
    }

    public function getFocus($id) {
        $activity = Activity::find($id);
        $user = Auth::user();
        return view('activities.student.focus', ['id' => $id, 'user' => $user]);
    }
}
