@extends ('partials.layout', ['title' => 'Activités à venir'])

@section ('content')
<div class="focus__wrapper">
    <h2 class="focus__title">{{ $activity->name }}</h2>
    <div class="focus__grid">
        <?php $i = 0; ?>
        @foreach($activity->images as $image)
            <figure class="grid__item" onclick="modal({{$i}})">
                <span class="item__text">
                    <i class="material-icons">comment</i> {{ count($image->comments) }}
                    <i class="material-icons">favorite</i> {{ count($image->likes) }}
                </span>
                <img src="{{asset('storage/'.$image->imgUrl.'')}}" alt="Photo {{$activity->name}} {{$i}}" class="item__img">
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
                        <span><a href="{{ route('delete.img', ['activityId' => $activity->id, 'imgId' => $image->id]) }}">Supprimer la photo</a></span>
                    </div>
                    @elseif($user->status == 2)
                    <div class="section-admin">
                        <span><a href="{{ route('report.photo', ['imageId' => $image->id]) }}">Signaler la photo</a></span>
                    @endif
                
                    </div>
                    
                @endif
                <div class="section-react-likes">
                    <span class="section-react-likes-content">
                    @if(!$image->likes->where('user_id', $user->id)->first())
                        <i id="like-{{$image->id}}" onclick="like({{$activity->id}}, {{$image->id}})" class="material-icons fav">favorite</i> 
                        <span id="like_count-{{$image->id}}">{{ count($image->likes) }}</span>
                    @else
                        <i id="like-{{$image->id}}" onclick="unlike({{$activity->id}}, {{$image->id}})" class="material-icons fav-color">favorite</i> 
                        <span id="like_count-{{$image->id}}">{{ count($image->likes) }}</span>
                    @endif
                        <span>@if (count($image->likes) <=1 ) personne aime cette photo @else personnes aiment cette photo @endif</span>
                    </span>
                </div>

                <div class="section-react-comments">
                    @foreach($image->comments as $comment)
                        <div class="section-react-comments-bloc">
                            <span class="section-react-comments-user">
                                {{$comment->user->where('id', $comment->user_id)->first()->firstname}} {{$comment->user->where('id', $comment->user_id)->first()->name}}
                            </span>
                            <span class="section-react-comments-content">{{$comment->content}}</span>
                            @if ($user->status == 1) 
                            <a href="{{ route('image.post.uncom', ['activityId' => $activity->id, 'comId' => $comment->id]) }}"><i class="material-icons xx">clear</i></a>
                            @elseif($user->status == 2)
                            <a href="{{ route('report.comment', ['commentId' => $comment->id]) }}">signaler</a>
                            @endif
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
        <form method="post" class="form login__form" enctype="multipart/form-data" action="{{ route('activites.focus.image.post', ['id' => $activity->id]) }}" >
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
        
        
        <input type="hidden" id="id" name="idea_id" value={{$user->id}}>

            {{ csrf_field() }}

            <div class="submit">
                <button type="submit" class="btn login__submit">VALIDER</button>
            </div>
        </form>
    </div>

    <div class="addIdea__fixed" id="addIdea__expand" onclick="expand()">
            <span>Ajouter une photo</span>
        </div>
@endif

@endsection


@section ('scripts')
    <script src="{{ asset('js/focus_ajax.js') }}"></script>
@endsection