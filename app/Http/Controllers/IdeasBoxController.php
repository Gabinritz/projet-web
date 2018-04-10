<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IdeasBoxController extends Controller
{
    public function getIndex() {
        return view('ideas-box.student.homepage');
    }

    public function getList() {
        return view('ideas-box.student.list');
    }

    public function postCreateIdea() {
        return redirect()->view('ideas-box.student.list');
    }

    public function getAdminCreateIdea() {
        return view('ideas-box.admin.create');
    }

    public function postAdminCreateIdea() {
        return redirect()->route('ideas-box.admin.manage');
    }
    public function getAdminManage() {
        return view('ideas-box.admin.manage');
    }
}
