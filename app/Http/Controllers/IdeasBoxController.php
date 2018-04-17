<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Idea;
use App\Vote;
use App\Activity;
use App\User;
use Auth;
use Notification;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;


class IdeasBoxController extends Controller
{
    public function getIndex() {
        $user = Auth::user();
        $users = User::all();
        $ideas = Idea::all();

        if(!$user) {
            return redirect()->route('login');
        }

        return view('ideas-box.student.index', ['ideas' => $ideas, 'user' => $user, 'users' => $users]);
    }

    public function getVoteIndex($id) {
        $user = Auth::user();

        if(!$user) {
            return redirect()->route('login');
        }

        $idea = Idea::where('id', $id)->first();
        $vote = new Vote([
            'user_id' => $user->id
        ]);
        $idea->votes()->save($vote);
        return redirect()->back();
    }

    public function getUnvoteIndex($id) {
        $user = Auth::user();

        if(!$user) {
            return redirect()->route('login');
        }

        $vote = Vote::where('idea_id', $id)->where('user_id', $user->id);
        $vote->delete();
        return redirect()->back();
    }

    public function postCreateIdea(Request $request) {
        $user = Auth::user();

        if(!$user) {
            return redirect()->route('login');
        }

        $idea = new Idea([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'user_id' => $user->id,
            'price' => $request->input('price'),
            'recurrent' => $request->input('recurrent')
        ]);
        $idea->save();
        return redirect()->route('ideas.index');
    }

    public function postAdminManage(Request $request) {
        $user = Auth::user();
        if ($request->hasFile('image')) {
            $request->file('image');
            $path = Storage::putFile('public', $request->file('image'));
            $path = str_replace('public/', '', $path);
        } else {
            $path = 'background.jpg';
        }

        if(!$user) {
            return redirect()->route('login');
        }
        
        $activity = new Activity([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'date' => $request->input('date'),
            'place' => $request->input('place'),
            'imgUrl' => $path,
            'price' => $request->input('price'),
            'recurrent' => $request->input('recurrent')
        ]);
        $idea = Idea::where('id', $request->input('idea_id'))->first();
        $idea->delete();
        $notification = new Notification([
            'message' => 'votre idée '.$idea->name.' a été retenue',
            'user_id' => $idea->user_id,
            'unread' => true
        ]);
        $notification->save();
        $activity->save();
        return redirect()->back();
    }
}