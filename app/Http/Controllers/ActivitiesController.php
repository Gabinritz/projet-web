<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivitiesController extends Controller
{
    public function getIndex() {
        return view('activities.student.homepage');
        //todo renvoyer les activités
    }

    public function getList() {
        return view('activities.student.list');
        //todo renvoyez activité
    }

    public function postSignUp() {
        return redirect()->route('activities.student.list');
        //validation et ajout user a evenement
    }

    public function getPast() {
        return view('activities.student.past');
        // récupérer anciennes
    }

    public function getFocus() {
        return view('activities.student.focus', ['$id' => 'id']);
        //récupérer une ancienne
    }

    public function getAdminFocus() {
        return view('activities.admin.focus', ['$id' => 'id']);
        //récupérer ancienne avec vue admin
    }
}
