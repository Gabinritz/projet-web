@include('partials.header')
accueil boite a idées
@foreach($ideas as $idea)
   <div>{{ $idea->name }} {{ count($idea->votes) }} likes | <a href="{{ route('ideas.like', ['id' => $idea->id])}}">Like</a> </div>
@endforeach 