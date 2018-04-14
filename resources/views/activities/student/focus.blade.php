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
                        <span>Supprimer la photo</span>
                    </div>
                @endif
                <div class="section-react-likes">
                    <span class="section-react-likes-content">
                        <i class="material-icons">favorite</i> {{ count($image->likes) }} 
                        @if (count($image->likes) <=1 ) personne aime cette photo @else personnes aiment cette photo @endif
                    </span>
                </div>

                <div class="section-react-comments">
                    @foreach($image->comments as $comment)
                        <div class="section-react-comments-bloc">
                            <span class="section-react-comments-user">
                                {{$comment->user->where('id', $comment->user_id)->first()->firstname}} {{$comment->user->where('id', $comment->user_id)->first()->name}}
                            </span>
                            <span class="section-react-comments-content">{{$comment->content}}</span>
                            @if ($user->status == 1) <i class="material-icons xx">more_vert</i> @endif
                        </div>
                    @endforeach
                    <input class="section-react-comments-add" type="text" placeholder="Ajouter un commentaire">
                </div>
            </section>
        </div>
    </div>
    <?php $j++; ?>
@endforeach

@if($user && $activity->participates->where('user_id', $user->id)->first())
Faire un form pour remplir image avec le nom et l'image si l'utilisateur a participé
<div><a href="{{ route('activites.focus.image.post', ['id' => $activity->id])}}">Poster une image</a></div>
@endif --}}

<script>
let modals = document.getElementsByClassName('modal')
let closes = document.getElementsByClassName('close')
let body = document.getElementById('body')

function modal(id) {
    for (let i=0; i<modals.length; i++) {
        let modal = document.getElementById('modal-' + id)
        let close = document.getElementById('close-' + id)
        let preview = document.getElementById('preview-' + id)
        let react = document.getElementById('react-' + id)
        let image = document.getElementById('img-' + id)

        modal.style.display = "flex"
        body.style.overflow = "hidden"

        close.onclick = function(event) { 
            modal.style.display="none"
            body.style.overflow = "auto"
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none"
                body.style.overflow = "auto"
            } 
        }
        
        if (window.matchMedia("(max-width: 992px)").matches) {
            close.onclick = function(event) { 
                    modal.style.display = "none"
                    body.style.overflow = "auto"               
                    react.style.display = "none"
                    image.style.display = "flex"
                    close.style.color = "#D90119"
                    preview.style.backgroundColor = "transparent"
                }
            preview.onclick = function(event) {
                react.style.display = "none"
                if (react.style.display == "none") {
                    react.style.display = "block"
                    image.style.display = "none"
                    close.style.color = "#212121"
                    preview.style.backgroundColor = "#212121"
                } else {
                    react.style.display = "none"
                    image.style.display = "flex"
                    close.style.color = "#D90119"
                    preview.style.backgroundColor = "transparent"
                }
            }
        }

        window.onresize = function(event) {
            if (window.matchMedia("(max-width: 992px)").matches) {
                react.style.display = "none"
                image.style.display = "flex"
                close.style.color = "#d90119" 
                preview.style.backgroundColor = "transparent"   
            } else if (window.matchMedia("(min-width: 992px)").matches) {
                react.style.display = "block"
                image.style.display = "flex"
                close.style.color = "#d90119" 
            }
        }
    }
}
</script>
@endsection