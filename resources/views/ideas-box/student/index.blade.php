@extends ('partials.layout', ['title' => 'Boite à idées'])

@section ('content')
<?php $status = 1; ?>
@if (!$ideas->isEmpty()) {{-- [MEMBRE DU BDE] --}}
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
                <td id="idea-nominator-{{ $i }}">{{$idea->nominator}}</td>
                <td id="idea-desc-{{ $i }}">{{$idea->description}}</td>
                <td>
                @if ($status) {{-- [MEMBRE DU BDE] --}}
                    <button class="btn accept__btn" id="btnAccept-{{ $i }}" onclick="accept()">ACCEPTER</button>
                @else {{-- [ETUDIANT ET AUTRES] --}}
                    <i class="material-icons thumb"><a href="{{ route('ideas.like', ['id' => $idea->id]) }}">thumb_up</a></i>
                    <span class="likes">{{ count($idea->votes) }}</span>
                @endif
                </td>
            </tr>
            <?php $i++ ?>
        @endforeach
        </table>
    </div>
@else {{-- [ETUDIANT] --}}
    <p>Aucune idée n'a été proposée</p>
@endif

@if ($status)
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

            <div class="group">      
                <input type="date" id="date" name="date" value = {{ date('Y-m-d') }} required>
                <span class="bar"></span>
                <label>Date</label>
            </div>

            {{ csrf_field() }}

            <div class="submit">
                <button type="submit" class="btn login__submit">VALIDER</button>
            </div>
        </form>
    </div>
@else {{-- [ETUDIANT] --}}
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

<div class="addIdea__fixed" id="addIdea__expand" onclick="expand()">
    <span>
    @if ($status) {{-- [MEMBRE DU BDE] --}}
        Accepter une idée   
    @else {{-- [ETUDIANT ET AUTRES] --}}
        Soumettre une idée au BDE
    @endif
    </span>
</div>

@endsection
