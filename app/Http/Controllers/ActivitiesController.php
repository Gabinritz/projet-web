<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;
use App\Participate;
use App\Image;
use App\Like;
use App\Comment;
use Auth;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use PDF;

class ActivitiesController extends Controller
{
    //page d'accueil
    public function getIndex() {
        $user = Auth::user();

        if(!$user) {
            return redirect()->route('login');
        }

        $activities = Activity::where('date', '>=', date('Y-m-d'))->take(20)->get();
        return view('activities.student.index', ['activities' => $activities, 'user' => $user]);
    }

    //page list activité
    public function getList($id) {
        $user = Auth::user();

        if(!$user || $user->status != 1) {
            return redirect()->route('login');
        }

        $activity = Activity::find($id);
        return view('activities.student.list', ['activity' => $activity, 'user' => $user]);
    }

    //inscription activité
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

    //avoir liste activités passées
    public function getPast() {
        $user = Auth::user();
        $activities = Activity::where('date', '<', date('Y-m-d'))->take(20)->get();
        return view('activities.student.past', ['user' => $user, 'activities' => $activities]);
    }

    //page focus sur activité passée
    public function getFocus($id) {
        $activity = Activity::find($id);
        $user = Auth::user();
        return view('activities.student.focus', ['activity' => $activity, 'user' => $user]);
    }


    //poster une image pour activité
    public function postImage($id, Request $request) {
        $user = Auth::user();

        if(!$user) {
            return redirect()->route('login');
        }

        $activity = Activity::where('id', $id)->first();
        
        if ($request->hasFile('image')) {
            $request->file('image');
            $path = Storage::putFile('public', $request->file('image'));
            $path = str_replace('public/', '', $path);
        } else {
            $path = 'background.jpg';
        }

        $image = new Image([
            'name' => $request->input('name'),
            'user_id' => $user->id,
            'imgUrl' => $path,
        ]);
        $activity->images()->save($image);
        return redirect()->back();
    }

    //like une photo
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

    //unlike une photo
    public function getUnlike($imgid, $id) {
        $user = Auth::user();

        if(!$user) {
            return redirect()->route('login');
        }

        $like = Like::where('user_id', $user->id)->where('image_id', $imgid)->first();
        $like->delete();
        return redirect()->back();
    }

    //poster un commentaire
    public function postComment(Request $request, $id, $imgId) {
        $user = Auth::user();

        if(!$user) {
            return redirect()->route('login');
        }
        
        $image = Image::find($imgId);
        $comment = new Comment([
            'user_id' => $user->id,
            'content' => $request->input('comment')
        ]);
        $image->comments()->save($comment);
        return redirect()->back();
    }

    //enlever commentaire
    public function getUncomment($activityId, $comId) {
        $user = Auth::user();

        if(!$user || $user->status != 1) {
            return redirect()->route('login');
        }

        $comment = Comment::find($comId);
        $comment->delete();
        return redirect()->back();
    }

    //supprimer image
    public function deleteImg($activityId, $imgId) {
        $user = Auth::user();

        if(!$user || $user->status != 1) {
            return redirect()->route('login');
        }

        $image = Image::find($imgId);
        $image->delete();
        return redirect()->route('activities.focus', ['id' => $activityId]);
    }

    public function dwPDF($id) {
        $user = Auth::user();

        if(!$user || $user->status != 1) {
            return redirect()->route('login');
        }

        $activityName = Activity::find($id)->name;
        $list= Participate::where('activity_id', $id)->get();
        $pdf = PDF::loadView('downloads.list_pdf', compact('order'), ['activity' => Activity::find($id)]);
        $name = "listeActivité-".$activityName.".pdf";
        return $pdf->download($name);
    }
}