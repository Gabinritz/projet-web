focus sur une ancienne activité
<h1>{{ $activity->name }}</h1>
@foreach($activity->images as $image)
<div>{{ $image->imgUrl }} lien de l'image</div>
<div>{{ count($image->likes) }} nbr de likes de l'image</div>
@foreach($activity->comments as $comment)
<div>Texte du commentaire {{ $comment->content}}</div>
<div>Auteur du commentaire {{$comment->user->where('id', $comment->user_id)->first()->firstname}} 
    {{$comment->user->where('id', $comment->user_id)->first()->name}}</div>
@endforeach
@endforeach

@if($activity->participates->where('user_id', $user->id)->first())
Faire un form pour remplir image avec le nom et l'image si l'utilisateur a participé
<div><a href="{{ route('activites.focus.image.post', ['id' => $activity->id])}}">Poster une image</a></div>
@endif