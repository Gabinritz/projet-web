@include('partials.header')
acceuil boite a idées
@foreach($ideas as $idea)
    {{ count($idea->votes) }} likes | <a href="{{ route('ideas.post.like', ['id' => $idea->id ]) }}">Like</a>
@endforeach 