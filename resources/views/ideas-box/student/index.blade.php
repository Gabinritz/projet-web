@extends ('partials.layout', ['title' => 'Boite à idées'])

@section ('content')
<div style="overflow-x: auto;" id="test">
<table>
    <tr>
        <th>Idée</th>
        <th>Organisateur</th>
        <th>Description</th>
        <th>Voter</th>
    </tr>
    <tr>
    @foreach($ideas as $idea)
        <td>{{$idea->name}}</td>
        <td>{{$idea->nominator}}</td>
        <td>{{$idea->description}}</td>
        <td>
            <i class="material-icons thumb"><a href="{{ route('ideas.like', ['id' => $idea->id]) }}">thumb_up</a></i>
            <span class="likes">{{ count($idea->votes) }}</span>
        </td>
    </tr>
    @endforeach
</table>
</div>

<div class="card hidden slideUp" id="addIdea">
<form action="{{ route('ideas.create.post') }}" method="post" class="form login__form">
        <div class="group">      
            <input type="text" 
            id="name"
            name="name"
            required>
            <span class="bar"></span>
            <label>Nom de l'activité</label>
        </div>
        
        <div class="group">      
            <input type="text" 
            id="description"
            name="description"
            required>
            <span class="bar"></span>
            <label>Description (255 max)</label>
        </div>

        {{ csrf_field() }}

        <div class="submit">
            <button type="submit" class="btn login__submit">VALIDER</button>
        </div>
    </form>
</div>
<div class="addIdea__fixed" id="addIdea__expand">
    <span>Soumettre une idée au BDE</span>
</div>

<script>
    form = document.getElementById('addIdea')
    expand = document.getElementById('addIdea__expand')

    expand.onclick = function(e) {
        if (form.classList.contains('hidden')) {
            form.classList.replace('hidden', 'visible')
        } else {
            form.classList.replace('visible', 'hidden')
        }
    }
</script>
@endsection
