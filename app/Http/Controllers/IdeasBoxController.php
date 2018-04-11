<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IdeasBoxController extends Controller
{
    public function getIndex() {
        return view('ideas-box.student.homepage');
        //récupérer idees
    }

    public function getList() {
        return view('ideas-box.student.list');
        //récupérer liste idées
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
