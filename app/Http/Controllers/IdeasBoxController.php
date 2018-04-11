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

    public function getList() {
        return view('ideas-box.student.list');
        //récupérer liste idées edit page peut etre a supprimer
    }

    public function postCreateIdea() {
        return redirect()->view('ideas-box.student.list');
        //validation et envoyer idée a bdd
    }

    public function getAdminCreateIdea() {
        return view('ideas-box.admin.create');
        
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
