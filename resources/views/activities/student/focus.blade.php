@extends ('partials.layout', ['title' => 'Activités à venir'])

@section ('content')
<div class="wrapper">
    <h2 class="focus__title">{{ $activity->name }}</h2>
    <div class="masonry masonry--h">
        <?php $i = 0; ?>
        @foreach($activity->images as $image)
            <figure class="masonry-brick masonry-brick--h" onclick="modal({{$i}})">
                <span class="masonry-text">
                    <i class="material-icons">comment</i> {{ count($image->comments) }}
                    <i class="material-icons">favorite</i> {{ count($image->likes) }}
                </span>
                <img src="{{ $image->imgUrl }}" alt="Photo {{$activity->name}} {{$i}}" id="masonry-img-{{$i}}" class="masonry-img">
            </figure>
            <?php $i++; ?>
        @endforeach
    </div>
</div>



<?php $j = 0; ?>
@foreach($activity->images as $image)
    <div id="modal-{{$j}}" class="modal">
        <div class="modal-content">
        <span class="close" id="close-{{$j}}">&times;</span>    
            <section class="section-img" id="img-{{$j}}">
                <img src="{{ $image->imgUrl }}" alt="{{$j}}" id="img-{{$j}}" class="modal-img">
            </section>
            <div class="section-react-preview" id="preview-{{$j}}">
                <span><i class="material-icons">favorite</i> {{ count($image->likes) }}</span>
                <span><i class="material-icons">comment</i> {{ count($image->comments) }}</span>
            </div>
            <section class="section-react" id="react-{{$j}}">
                @if ($user->status == 1)
                    <div class="section-admin">
                        <span><a href="{{ route('delete.img', ['activityId' => $activity->id, 'imgId' => $image->id]) }}">Supprimer la photo {{$image->id}}</a></span>
                    </div>
                @endif
                <div class="section-react-likes">
                    <span class="section-react-likes-content">
                    @if(!$image->likes->where('user_id', $user->id)->first())
                        <i class="material-icons">
                            <a href="{{ route('image.get.like', ['imgId' => $image->id, 'activityId' => $activity->id]) }}">favorite</a>
                        </i> {{ count($image->likes) }}
                    @else
                        <i class="material-icons">
                                <a href="{{ route('image.get.unlike', ['imgId' => $image->id, 'activityId' => $activity->id]) }}">favorite</a>
                        </i> {{ count($image->likes) }}
                    @endif
                        @if (count($image->likes) <=1 ) | personne aime cette photo @else | personnes aiment cette photo @endif
                    </span>
                </div>

                <div class="section-react-comments">
                    @foreach($image->comments as $comment)
                        <div class="section-react-comments-bloc">
                            <span class="section-react-comments-user">
                                {{$comment->user->where('id', $comment->user_id)->first()->firstname}} {{$comment->user->where('id', $comment->user_id)->first()->name}}
                            </span>
                            <span class="section-react-comments-content">{{$comment->content}}</span>
                            @if ($user->status == 1) <a href="{{ route('image.post.uncom', ['activityId' => $activity->id, 'comId' => $comment->id]) }}"><i class="material-icons xx">more_vert</   i></a> @endif
                        </div>
                    @endforeach
                    <form action="{{ route('image.post.com', ['imgid' => $image->id, 'id' => $activity->id]) }}" method="post">
                        @csrf
                        <input class="section-react-comments-add" type="text" placeholder="Ajouter un commentaire" name="comment" required>
                        <input type="submit" placeholder="valider">
                    </form>
                    
                </div>
            </section>
        </div>
    </div>
    <?php $j++; ?>
@endforeach

@if($user && $activity->participates->where('user_id', $user->id)->first())
Faire un form pour remplir image avec le nom et l'image si l'utilisateur a participé
<div><a href="{{ route('activities.focus', ['id' => $activity->id])}}">Poster une image</a></div>
@endif

@endsection