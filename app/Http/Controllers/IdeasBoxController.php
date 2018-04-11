<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Idea;
use App\Vote;

class IdeasBoxController extends Controller
{
    public function getIndex() {
        $ideas = Idea::all();
        return view('ideas-box.student.homepage', ['ideas' => $ideas]);
    }

    public function getLikeIndex($id) {
        $idea = Idea::where('id', $id)->first();
        $vote = new Vote();
        $idea->votes()->save($vote);
        return redirect()->back();
    }

    public function postCreateIdea() {
        return redirect()->view('ideas-box.student.homepage');
        //validation et envoyer idée a bdd
    }

    public function postAdminCreateIdea() {
        return redirect()->route('ideas-box.admin.manage');
        //validation et envoyer activité a bdd
    }
    
    public function getAdminManage() {
        return view('ideas-box.admin.manage');
        //validation et envoier idée en activité
    }
}
