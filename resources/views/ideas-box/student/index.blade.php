@extends ('partials.layout', ['title' => 'Boite à idées'])

@section ('content')
<div class="container" style="text-align: center; margin-top: 2rem;">
@if (!$ideas->isEmpty()) {{-- [DONNEES DANS IDEES] --}}
    <?php $i = 0; ?>
    <div style="overflow-x: auto;" id="test">
        <table>
            <tr>
                <th>Idée</th>
                <th>Organisateur</th>
                <th>Description</th>
                <th>Voter</th>
            </tr>
        @foreach($ideas as $idea)
            <tr id="idea-{{ $i }}">
                <td id="idea-name-{{ $i }}">{{$idea->name}}</td>
                <td id="idea-nominator-{{ $i }}">{{$idea->user->where('id', $idea->user_id)->first()->firstname}} 
                    {{$idea->user->where('id', $idea->user_id)->first()->name}}</td>
                <td id="idea-desc-{{ $i }}">{{$idea->description}}</td>
                <td>
                @if ($user->status == 1) {{-- [MEMBRE DU BDE] --}}
                    <button class="btn accept__btn" id="btnAccept-{{ $i }}" onclick="accept()">ACCEPTER</button>
                @else {{-- [ETUDIANT ET AUTRES] --}}
                    @if($idea->user_id == $user->id)
                        <i class="material-icons thumb thumb-black">thumb_up</i>
                    @elseif(!$idea->votes->where('user_id', $user->id)->first())
                        <i class="material-icons thumb thumb-black"><a href="{{ route('ideas.vote', ['id' => $idea->id]) }}">thumb_up</a></i>
                    @else
                        <i class="material-icons thumb thumb-green"><a href="{{ route('ideas.unvote', ['id' => $idea->id]) }}">thumb_up</a></i>
                    @endif
                    <span class="likes">{{ count($idea->votes) }}</span>
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
        <form method="post" class="form login__form" enctype="multipart/form-data" action="{{ route('ideas.admin.manage.post') }}" >
            <div class="group">   
                <input type="text" id="name" name="name" required
                @if (!$ideas->isEmpty())
                    value="{{$idea->name}}">
                @endif
                <span class="bar"></span>
                <label>Nom de l'activité</label>
            </div>

            <div class="group">      
                <input type="text"  id="description" name="description" required
                @if (!$ideas->isEmpty())
                    value="{{$idea->description}}">
                @endif
                <span class="bar"></span>
                <label>Description (255 max)</label>
            </div>

            <div class="group">      
                <input type="date" id="date" name="date" value = {{ date('Y-m-d') }} required>
                <span class="bar"></span>
                <label>Date</label>
            </div>

            <div class="group">      
                <input type="text"  id="place" name="place" required>
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
        
        
        <input type="hidden" id="id" name="idea_id" value=
        @if (!$ideas->isEmpty())
        "{{ $idea->id }}">
        @endif

            {{ csrf_field() }}

            <div class="submit">
                <button type="submit" class="btn login__submit">VALIDER</button>
            </div>
        </form>
    </div>
@elseif ($user->status != 1) {{-- [ETUDIANT] --}}
    <div class="card hidden slideUp" id="addIdea">
        <form method="post" class="form login__form" action="{{ route('ideas.create.post') }}" >
            <div class="group">      
                <input type="text" id="name" name="name" required>
                <span class="bar"></span>
                <label>Nom de l'activité</label>
            </div>
                
            <div class="group">      
                <input type="text"  id="description" name="description" required>
                <span class="bar"></span>
                <label>Description (255 max)</label>
            </div>

            {{ csrf_field() }}

            <div class="submit">
                <button type="submit" class="btn login__submit">VALIDER</button>
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
