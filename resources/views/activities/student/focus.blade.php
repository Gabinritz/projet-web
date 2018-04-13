@extends ('partials.layout', ['title' => 'Activités à venir'])

@section ('content')
<div class="wrapper">
    <h2 class="focus__title">{{ $activity->name }}</h2>
    <div class="masonry masonry--h">
        <?php $i = 0; ?>
        @foreach($activity->images as $image)
        <figure class="masonry-brick masonry-brick--h" onclick="displayPic({{$i}})">
        <img src="{{ $image->imgUrl }}" alt="{{$i}}" id="img-{{$i}}" class="masonry-img">
        </figure>
        <?php $i++; ?>
        @endforeach
    </div>
</div>
{{-- @foreach($activity->images as $image)
<div>{{ $image->imgUrl }} lien de l'image</div>
<a href="{{ route('image.post.like', ['id'=>$image->id]) }}">LIKE</a>
<div>{{ count($image->likes) }} nbr de likes de l'image</div>
@foreach($image->comments as $comment)
<div>
    <p>
    </p>{{$comment->user->where('id', $comment->user_id)->first()->firstname}} 
    {{$comment->user->where('id', $comment->user_id)->first()->name}}</div>
<div>Texte du commentaire {{ $comment->content}}</div>
@endforeach
@endforeach

@if($user && $activity->participates->where('user_id', $user->id)->first())
Faire un form pour remplir image avec le nom et l'image si l'utilisateur a participé
<div><a href="{{ route('activites.focus.image.post', ['id' => $activity->id])}}">Poster une image</a></div>
@endif --}}
@endsection