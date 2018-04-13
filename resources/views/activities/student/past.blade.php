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
                <th>Détails</th>
            </tr>
        
            <tr id="activity-1">
                <td id="activity-name-1">Foot</td>
                <td id="activity-date-1">{{ date('d-m-Y') }}</td>
                <td id="activity-desc-1">Qui met des petits ponts à Amine</td>
                <td id="activity-place-1">Strasbourg</td>
                <td><button class="btn accept__btn" id="btnAccept-1" onclick="accept()">DÉTAILS</button></td>
            </tr>
            <?php $i++ ?>
        </table>
    </div>
{{-- @else
    <p>Aucune activité à venir</p>
@endif --}}
</div>
@endsection
