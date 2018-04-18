@extends ('partials.layout', ['title' => 'Boite à idées'])

@section ('content')
<div class="container" style="text-align: center; margin-top: 2rem;">
@if (!$ideas->isEmpty()) {{-- [DONNEES DANS IDEES] --}}
<div style="overflow-x: auto;" id="test">
    <table>
        <tr>
            <th>Idée</th>
            <th>Organisateur</th>
            <th>Description</th>
            <th>Voter</th>
        </tr>
        <?php $i = 1; ?>
        @foreach($ideas as $idea)
        <tr id="idea-{{ $idea->id }}">
                <td id="idea-name-{{ $i }}">{{$idea->name}}</td>
                <td id="idea-nominator-{{ $i }}">{{$idea->user->where('id', $idea->user_id)->first()->firstname}} 
                    {{$idea->user->where('id', $idea->user_id)->first()->name}}</td>
                <td id="idea-desc-{{ $i }}">{{$idea->description}}</td>
                <td>
                @if ($user->status == 1) {{-- [MEMBRE DU BDE] --}}
                    <svg class="idea__delete" id="idea-delete-{{$idea->id}}" onclick="deleteIdea({{$idea->id}})" fill="#212121" height="32" viewBox="0 0 24 24" width="32" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                        <path d="M0 0h24v24H0z" fill="none"/>
                    </svg>
                    <svg class="idea__accept" id="idea-accept-{{$idea->id}}" onclick="accept({{$idea->id}})" fill="#000000" height="32" viewBox="0 0 24 24" width="32" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 0h24v24H0z" fill="none"/>
                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                    </svg>
                @else {{-- [ETUDIANT ET AUTRES] --}}
                    @if($idea->votes->where('user_id', $user->id)->first())
                        <i class="material-icons thumb thumb-green" id="thumb-{{$idea->id}}" onclick="unvote({{$idea->id}})">thumb_up</i>
                    @else              
                        <i class="material-icons thumb thumb-black" id="thumb-{{$idea->id}}" onclick="vote({{$idea->id}})">thumb_up</i>
                    @endif
                    <span class="likes" id="vote_count-{{$idea->id}}">{{ count($idea->votes) }}</span>
                @endif
                </td>
            <span id="idea-id-{{ $i }}" style="display: none">{{ $idea->id }}</span>
            </tr>
            <?php $i++ ?>
        @endforeach
        </table>
    </div>
@else {{-- [PAS DE DONNEES] --}}
    <p>Aucune idée n'a été proposée</p>
@endif
</div>

@if ($user->status == 1 && !$ideas->isEmpty()) {{-- [MEMBRE DU BDE] --}}
    <div class="card hidden slideUp" id="addIdea">
        <form method="post" class="form login__form" id="formBde" enctype="multipart/form-data">
            <div class="group">   
                <input type="text" id="name" name="name" required
                onkeyup="checkText(this)"
                @if (!$ideas->isEmpty())
                    value="{{$idea->name}}">
                @endif
                <span class="bar"></span>
                <label>Nom de l'activité</label>
            </div>

            <div class="group">      
                <input type="text"  id="description" name="description" required onkeyup="checkText(this)"
                @if (!$ideas->isEmpty())
                    value="{{$idea->description}}">
                @endif
                <span class="bar"></span>
                <label>Description (255 max)</label>
            </div>

            <div class="group">      
                <input type="date" id="date" name="date" value = {{ date('Y-m-d') }} required onkeyup="checkText(this)">
                <span class="bar"></span>
                <label>Date</label>
            </div>

            <div class="group">      
                <input type="text"  id="place" name="place" required onkeyup="checkText(this)">
                <span class="bar"></span>
                <label>Lieu</label>
            </div>

            <div class="group">
                <input type="number" name="price" id="price">
                <span class="bar"></span>
                <label>Ajouter un prix</label>
            </div>

            <div class="group">
                <input type="radio" name="recurrent" id="recurrent" value="1" required>Oui
                <input type="radio" name="recurrent" id="recurrent" value="0" required>Non
                <span class="bar"></span>
                <label>Activité récurrente</label>
            </div>

            <div class="group">
                <input type="file" name="image" id="image">
                <span class="bar"></span>
                <label>Ajouter une image</label>
            </div>
        
        
        <input type="hidden" id="id" name="id" value=
        @if (!$ideas->isEmpty())
        "{{ $idea->id }}">
        @endif

            {{ csrf_field() }}

            <div class="submit">
                <button type="submit" id="submitBde" class="btn login__submit">VALIDER</button>
            </div>
        </form>
    </div>
@elseif ($user->status != 1) {{-- [ETUDIANT] --}}
    <div class="card hidden slideUp" id="addIdea">
        <form method="post" class="form login__form" id="formStudent" >
            <div class="group">      
                <input type="text" id="name" name="name" required onkeyup="checkText(this)">
                <span class="bar"></span>
                <label>Nom de l'activité</label>
            </div>
                
            <div class="group">      
                <input type="text"  id="description" name="description" required onkeyup="checkText(this)">
                <span class="bar"></span>
                <label>Description (255 max)</label>
            </div>

            <div class="group">      
                <input type="text"  id="place" name="place" required onkeyup="checkText(this)">
                <span class="bar"></span>
                <label>Lieu</label>
            </div>

            {{ csrf_field() }}

            <div class="submit">
                <button type="submit" id="submitStudent" class="btn login__submit">VALIDER</button>
            </div>
        </form>
    </div>
@endif

@if ($user->status == 1 && !$ideas->isEmpty()) {{-- [MEMBRE DU BDE] --}}
    <div class="addIdea__fixed" id="addIdea__expand" onclick="expand()">
        <span>
            Accepter une idée
        </span>
    </div>
@elseif ($user->status != 1) {{-- [ETUDIANT ET AUTRES] --}}
    <div class="addIdea__fixed" id="addIdea__expand" onclick="expand()">
        <span>
            Soumettre une idée au BDE
        </span>
    </div>
@endif

@endsection

@section ('scripts')
    <script src="{{ asset('js/ideas_ajax.js') }}"></script>
@endsection


