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
                <img src="{{asset('storage/'.$image->imgUrl.'')}}" alt="Photo {{$activity->name}} {{$i}}" id="masonry-img-{{$i}}" class="masonry-img">
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
                <img src="{{asset('storage/'.$image->imgUrl.'')}}" alt="{{$j}}" id="img-{{$j}}" class="modal-img">
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
                            favorite
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
                            @if ($user->status == 1) <i class="material-icons xx">more_vert</   i> @endif
                        </div>
                    @endforeach
                    <form action="{{ route('image.post.com', ['imgid' => $image->id, 'id' => $activity->id]) }}" method="post">
                        @csrf
                        <input class="section-react-comments-add" type="text" placeholder="Ajouter un commentaire" name="comment" required>
                        <button class="comment-send" type="submit"></button>
                    </form>
                    
                </div>
            </section>
        </div>
    </div>
    <?php $j++; ?>
@endforeach

{{-- @if($user && $activity->participates->where('user_id', $user->id)->first()) --}}
@if (1)
<div class="card hidden slideUp" id="addIdea">
        <form method="post" class="form login__form" enctype="multipart/form-data" action="{{ route('activities.focus', ['id' => $activity->id])}}" >
            <div class="group">   
                <input type="text" id="name" name="name" required
                <span class="bar"></span>
                <label>Titre de la photo</label>
            </div>

            <div class="group">
                <input type="file" name="image" id="image">
                <span class="bar"></span>
                <label>Ajouter une image</label>
            </div>
        
        
        <input type="hidden" id="id" name="idea_id" value={{$user->id}}

            {{ csrf_field() }}

            <div class="submit">
                <button type="submit" class="btn login__submit">VALIDER</button>
            </div>
        </form>
    </div>

    <div class="addIdea__fixed" id="addIdea__expand" onclick="expand()">
            <span>
                Ajouter une photo
            </span>
        </div>
@endif

@endsection