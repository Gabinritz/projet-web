@extends ('partials.layout', ['title' => 'Activités passées'])

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
                <th>Nombre de Participants</th>
                <th>Détails</th>
            </tr>
        
            @foreach($activities as $activity)
            <tr id="activity-1">
                <td id="activity-name-1">{{ $activity->name }}</td>
                <td id="activity-date-1">{{ $activity->date }}</td>
                <td id="activity-desc-1">{{ $activity->description}}</td>
                <td id="activity-place-1">{{ $activity->place}}</td>
                <td id="activity-participants-1">{{ count($activity->participates) }}
                @if($user && $activity->participates->where('user_id', $user->id)->first())
                | Vous y avez participé
                @else
                | Vous n'y avez pas participé
                @endif
            </td>
            <td><a href="{{ route('activities.focus', ['id' => $activity->id]) }}"><button class="btn accept__btn" id="btnAccept-1" onclick="accept()">DÉTAILS</button></a></td>
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
