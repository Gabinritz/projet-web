<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Idea;
use App\Vote;
use App\Activity;
use App\User;
use Auth;
use Notification;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Response;

class IdeasBoxController extends Controller
{
    public function getIndex() {
        $user = Auth::user();
        $users = User::all();
        $ideas = Idea::all();

        if(!$user) {
            return redirect()->route('login');
        }

        return view('ideas-box.student.index', ['ideas' => $ideas, 'user' => $user, 'users' => $users]);
    }

// ========== ETUDIANT ==========
    public function getIdea($id) {
        $idea = Idea::find($id);
        return Response::json($idea);
    }

    // VOTER
    public function vote(Request $request) {
        $user = Auth::user();
        if(!$user) { return redirect()->route('login'); }
    
        $data = $request->all();
        $id = $data['id'];
    
        $idea = Idea::where('id', $id)->first();
        $vote = new Vote(['user_id' => $user->id]);
        $idea->votes()->save($vote);
        return Response::json($data);
    }

    // ANNULER VOTE
    public function unvote($id) {
        $user = Auth::user();
        if(!$user) { return redirect()->route('login'); }
    
        $vote = Vote::where('idea_id', $id)->where('user_id', $user->id);
        $vote->delete();
        return Response::json($vote);
    }

    // SOUMETTRE UNE IDEE
    public function add(Request $request) {
        $user = Auth::user();
        if(!$user) { return redirect()->route('login'); }

        $data = $request->all();
        $name = $data['name'];
        $description = $data['description'];
        $place = $data['place'];

        $idea = new Idea([
            'name' => $name,
            'description' => $description,
            'place' => $place,
            'user_id' => $user->id
        ]);
        $idea->save();
        $result = [
            'name' => $idea->name,
            'description' => $idea->description,
            'place' => $idea->place,
            'organisateur' => ''.$user->firstname.' '.$user->name.''
        ];

        return Response::json($result);
    }


// ========== BDE ==========
    // SUPPRIMER
    public function delete($id) {
        $user = Auth::user();
        if(!$user) { return redirect()->route('login'); }
    
        $idea = Idea::where('id', $id)->first();
        $idea->delete();
        return Response::json($idea);
    }

    // VALIDER
    public function valid(Request $request) {
        $user = Auth::user();
        if(!$user) {
            return redirect()->route('login');
        }

        $data = $request->all();
        if ($data['image'] != NULL) {
            $path = $request->image->store('public');
            $request->image = $path;
        }

        $id = $data['id'];
        $name = $data['name'];
        $description = $data['description'];
        $date = $data['date'];
        $price = $data['price'];
        $place = $data['place'];
        $recurrent = $data['recurrent'];
        $image = $data['image'];

        if ($path != NULL) {
            $path = Storage::putFile('public', $image);
            $path = str_replace('public/', '', $path);
        } else {
            $path = 'background.jpg';
        }

        $activity = new Activity([
            'name' => $name,
            'description' => $description,
            'date' => $date,
            'place' => $place,
            'date' => $date,
            'imgUrl' => $path,
            'price' => $price,
            'recurrent' => $recurrent
        ]);
        $idea = Idea::where('id', json_decode($id))->first();
        $idea->delete();
        $activity->save();
        return Response::json($data);
        /*         $notification = new Notification([
                    'message' => 'votre idée '.$idea->name.' a été retenue',
                    'user_id' => $idea->user_id,
                    'unread' => true
                ]);
                $notification->save(); */
    }
}