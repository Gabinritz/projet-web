<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Idea;
use App\Vote;
use Auth;

class IdeasBoxController extends Controller
{
    public function getIndex() {
        $user = Auth::user();
        $ideas = Idea::all();
        return view('ideas-box.student.index', ['ideas' => $ideas, 'user' => $user]);
    }

    public function getLikeIndex($id) {
        $idea = Idea::where('id', $id)->first();
        $vote = new Vote();
        $idea->votes()->save($vote);
        return redirect()->back();
    }

    public function postCreateIdea(Request $request) {
        //validation a faire en java
        $idea = new Idea([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'nominator' => 'GabinTest'
        ]);
        $idea->save();
        return redirect()->route('ideas.index')->with('info', 'Idée Ajoutée :' . $request->input('name'));
    }

    public function postAdminCreateIdea() {
        return redirect()->route('ideas-box.admin.manage');
        //validation et envoyer activité a bdd
    }
    
    public function getAdminManage() {
        $user = Auth::user();
        return view('ideas-box.admin.manage', ['user' => $user]);
        //validation et envoier idée en activité
    }
}
