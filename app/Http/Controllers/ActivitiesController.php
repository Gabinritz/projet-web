<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;
use App\Participate;
use App\Image;
use App\Like;
use App\Comment;
use Auth;

class ActivitiesController extends Controller
{
    public function getIndex() {
        $user = Auth::user();

        if(!$user) {
            return redirect()->route('login');
        }

        $activities = Activity::where('date', '>=', date('Y-m-d'))->take(20)->get();
        return view('activities.student.index', ['activities' => $activities, 'user' => $user]);
    }

    public function postSignUp($id) {
        $user =  Auth::user();

        if(!$user) {
            return redirect()->route('login');
        }

        $activity = Activity::where('id', $id)->first();
        $participation = new Participate([
            'user_id' => $user->id
        ]);
        $activity->participates()->save($participation);
        return redirect()->route('activities.index');
    }

    public function getPast() {
        $user = Auth::user();
        $activities = Activity::where('date', '<=', date('Y-m-d'))->take(20)->get();
        return view('activities.student.past', ['user' => $user, 'activities' => $activities]);
    }

    public function getFocus($id) {
        $activity = Activity::find($id);
        $user = Auth::user();
        return view('activities.student.focus', ['activity' => $activity, 'user' => $user]);
    }

    public function postImage($id, Request $request) {
        $user = Auth::user();

        if(!$user) {
            return redirect()->route('login');
        }

        $activity = Activity::where('id', $id)->first();
        $image = new Image([
            'imgUrl' => $request->input('imgUrl'),
            'name' => $request->input('name'),
            'user_id' => $user->id
        ]);
        $activity->images()->save();
        return redirect()->back();
    }

    public function getLike($imgid, $id) {
        $user = Auth::user();

        if(!$user) {
            return redirect()->route('login');
        }

        $image = Image::where('id', $imgid)->first();
        $like = new Like([
            'user_id' => $user->id
        ]);
        $image->likes()->save($like);
        return redirect()->back();
    }

    public function postComment($id, Request $request) {
        $user = Auth::user();

        if(!$user) {
            return redirect()->route('login');
        }
        
        $image = Image::where('id', $id)->first();
        $comment = new Comment([
            'user_id' => $user->id,
            'content' => $request->input('content')
        ]);
        $image->comments()->save($comment);
        return redirect()->back();
    }
}