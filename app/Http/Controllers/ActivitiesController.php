<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivitiesController extends Controller
{
    public function getIndex() {
        return view('activities.student.homepage');
    }

    public function getList() {
        return view('activities.student.list');
    }

    public function postSignUp() {
        return redirect()->route('activities.student.list');
    }

    public function getPast() {
        return view('activities.student.past');
    }

    public function getFocus() {
        return view('activities.student.focus', ['$id' => 'id']);
    }

    public function getAdminFocus() {
        return view('activities.admin.focus', ['$id' => 'id']);
    }
}
