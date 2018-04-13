@extends ('partials.layout', ['title' => 'Activités à venir'])

@section ('content')
<div class="container">
{{-- @if (1) (!$ideas->isEmpty()) [MEMBRE DU BDE] --}}
    <?php $i = 0; ?>
    <div style="overflow-x: auto;" id="test">
        <table>
            <tr>
                <th>Activité</th>
                <th>Date</th>
                <th>Description</th>
                <th>Lieu</th>
                <th>Nombre de participants</th>
                <th>S'inscrire</th>
            </tr>
            
            @foreach($activities as $activity)
            <tr id="activity-1">
                <td id="activity-name-1">{{ $activity->name }}</td>
                <td id="activity-date-1">{{ $activity->date }}</td>
                <td id="activity-desc-1">{{ $activity->description}}</td>
                <td id="activity-place-1">{{ $activity->place}}</td>
                <td id="activity-participants-1">{{ count($activity->participates) }}</td>
                @if($activity->participates->where('user_id', $user->id)->first())
                <td><div>Inscrit</div></td>
                @else
                <td><a href="{{ route('activities.signup.post', ['id' => $activity->id]) }}"><button class="btn accept__btn" id="btnAccept-1" onclick="accept()">S'INSCRIRE</button></a></td>
                @endif
            </tr>
            <?php $i++ ?>
            @endforeach
        </table>
    </div>
{{-- @else
    <p>Aucune activité à venir</p>
@endif --}}
</div>
@endsection
