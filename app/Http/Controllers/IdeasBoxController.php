<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Idea;
use App\Vote;
use App\Activity;
use Auth;

class IdeasBoxController extends Controller
{
    public function getIndex() {
        $user = Auth::user();
        $ideas = Idea::all();
        return view('ideas-box.student.index', ['ideas' => $ideas, 'user' => $user]);
    }

    public function getVoteIndex($id) {
        $user = Auth::user();
        $idea = Idea::where('id', $id)->first();
        $vote = new Vote([
            'user_id' => $user->id
        ]);
        $idea->votes()->save($vote);
        return redirect()->back();
    }

    public function postCreateIdea(Request $request) {
        $user = Auth::user();
        $nominator = $user->firstname .' '. $user->name;
        $idea = new Idea([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'nominator' => $nominator
        ]);
        $idea->save();
        return redirect()->route('ideas.index')->with('info', 'Idée Ajoutée :' . $request->input('name'));
    }

    public function postAdminManage(Request $request) {
        $user = Auth::user();
        $activity = new Activity([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'date' => $request->input('date'),
            'place' => $request->input('place')
        ]);
        $idea = Idea::where('id', $request->input('id'))->first();
        $idea->delete();
        $activity->save();
        return redirect()->back();
    }
}