<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;
use App\Participate;
use App\Image;
use App\Like;
use App\Comment;
use App\User;
use App\Notification;
use Auth;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use PDF;
use League\Csv\Writer;
use Response;

class ActivitiesController extends Controller
{
    //page d'accueil
    public function getIndex() {
        $user = Auth::user();

        if(!$user) {
            return redirect()->route('login');
        }
        
        //retourne les activités à la vue
        $activities = Activity::where('date', '>=', date('Y-m-d'))->take(20)->get();
        return view('activities.student.index', ['activities' => $activities, 'user' => $user]);
    }

    //Like une photo d'activité
    public function like(Request $request) {
        $user = Auth::user();
        if(!$user) { return redirect()->route('login'); }
    
        $data = $request->all();
        $idActivity = $data['idActivity'];
        $idPhoto = $data['idPhoto'];

        $image = Image::where('id', $idPhoto)->first();
        $like = new Like(['user_id' => $user->id]);
        $image->likes()->save($like);
        return Response::json($data);
    }

    //unlike une photo d'activité
    public function unlike($idActivity, $idPhoto) {
        $user = Auth::user();
        if(!$user) { return redirect()->route('login'); }

        $like = Like::where('user_id', $user->id)->where('image_id', $idPhoto)->first();
        $like->delete();
        return Response::json($like);
    }


    public function comment(Request $request) {
        $user = Auth::user();
        if(!$user) { return redirect()->route('login'); }

        $data = $request->all();
        $idPhoto = $data['idPhoto'];
        $content = $data['comment'];
        
        $image = Image::find($idPhoto);
        $comment = new Comment([
            'user_id' => $user->id,
            'content' => $content
        ]);
        $image->comments()->save($comment);
        $result = [
            'user' => ''.$user->firstname.' '.$user->name.'',
            'content' => $content
        ];

        return Response::json($result);
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

        if(!$user) {
            return redirect()->route('login');
        }
        
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
    //signaler activité par Cesi
    public function reportActivity($activityId) {
        $user = Auth::user();
        //check si BDE
        if(!$user || !$user->status == 2) {
            return redirect()->route('login');
        }
        $activity = Activity::find($activityId);
        $bdeMembers = User::where('status', 1)->get();

        $content = 'L\'activité '.$activity->name.' doit etre supprimée';

        foreach($bdeMembers as $member) {
            $i = 0;
            $notification = new Notification([
                'message' => $content,
                'user_id' => $bdeMembers[$i]->id,
                'unread' => true
            ]);
            $notification->save();
            $i++;
        }

        return redirect()->back();
    }
    //signaler un commentaire
    public function reportComment($commentId) {
        $user = Auth::user();
        //check si BDE
        if(!$user || !$user->status == 2) {
            return redirect()->route('login');
        }

        $bdeMembers = User::where('status', 1)->get();

        $comment = Comment::find($commentId);
        $autor = User::find($comment->user_id);
        $photo = Image::find($comment->image_id);

        $content = "Le commentaire : '".$comment->content."' de ".$autor->firstname." ".$autor->name." sur la photo ".$photo->name." doit être supprimé";

        foreach($bdeMembers as $member) {
            $i = 0;
            $notification = new Notification([
                'message' => $content,
                'user_id' => $bdeMembers[$i]->id,
                'unread' => true
            ]);
            $notification->save();
            $i++;
        }

        return redirect()->back();
    }

    //signalé la photo par cesi
    public function reportPhoto($ImageId) {
        $user = Auth::user();
        //check si BDE
        if(!$user || !$user->status == 2) {
            return redirect()->route('login');
        }
        $photo = Image::find($ImageId);
        $autor = User::find($photo->user_id);
        $activity = Activity::find($photo->activity_id);

        $bdeMembers = User::where('status', 1)->get();

        $content = 'La photo : '.$photo->name.' de '.$autor->firstname.' '.$autor->name.' sur l\'activité '.$activity->name.' doit être supprimée';

        foreach($bdeMembers as $member) {
            $i = 0;
            $notification = new Notification([
                'message' => $content,
                'user_id' => $bdeMembers[$i]->id,
                'unread' => true
            ]);
            $notification->save();
            $i++;
        }

        return redirect()->back();
    }

    //supprimer activité par bde
    public function deleteActivity($activityId) {
        $user = Auth::user();
        //check si BDE
        if(!$user || $user->status != 1) {
            return redirect()->route('login');
        }
        $activity = Activity::find($activityId);
        $activity->delete();

        return redirect()->back();
    }

    //télécharger au fomat PDF
    public function dwPDF($id) {
        $user = Auth::user();

        if(!$user || $user->status != 1) {
            return redirect()->route('login');
        }

        $activityName = Activity::find($id)->name;
        $list= Participate::where('activity_id', $id)->get();
        $pdf = PDF::loadView('downloads.list_pdf', compact('order'), ['activity' => Activity::find($id)]);
        $name = "listeParticipantsActivité-".$activityName.".pdf";
        return $pdf->download($name);
    }

    //télécharger au format CSV
    public function dwCSV($id) {
        $user = Auth::user();

        if(!$user || $user->status != 1) {
            return redirect()->route('login');
        }

        $activity = Activity::find($id);
        $list= Participate::where('activity_id', $id)->get();

        $csv = Writer::createFromFileObject(new \SplTempFileObject());
        $csv->setNewline("\r\n");
        $csv->insertOne(['Nom', 'Prenom', 'Email', 'Date Inscription', 'Statut',]);
        $csv->getNewLine();
        $status = 0;
         
        //on écrit ligne par ligne
        foreach($activity->participates as $participant) {

            //cherche statut étudiant
            if($participant->user->where('id', $participant->user_id)->first()->status = 0) {
                $status = 'Etudiant'; 
            }
            elseif($participant->user->where('id', $participant->user_id)->first()->status = 1) {
                $status = 'Membre BDE';
            }
            else {
                $status = 'Salarié Cesi';
            }
            $csv->insertOne([
                $participant->user->where('id', $participant->user_id)->first()->name,
                $participant->user->where('id', $participant->user_id)->first()->firstname,
                $participant->user->where('id', $participant->user_id)->first()->email,
                $participant->where('user_id', $participant->user_id)->first()->created_at,
                $status,
                
            ]);
            $csv->getNewLine();
        }

        $csv->output('listeParticipantsActivité-'.$activity->name.'.csv');  
    }
}
