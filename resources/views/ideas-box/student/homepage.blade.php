@extends ('partials.layout', ['title' => 'Boite à idées'])

@section ('content')
<table>
    <tr>
        <th>Activité</th>
        <th>Organisateur</th>
        <th>Date</th>
        <th>Lieu</th>
        <th>Voter</th>
    </tr>
    <tr>
        <td>Test</td>
        <td>Test</td>
        <td>1 janvier 2019</td>
        <td>Strasbourg</td>
        <td><i class="material-icons">thumb_up</i></td>
    </tr>
    <tr>
        <td>Test</td>
        <td>Test</td>
        <td>/</td>
        <td>Mulhouse</td>
        <td><i class="material-icons">thumb_up</i></td>
    </tr>
    <tr>
        <td>Test</td>
        <td>Test</td>
        <td>avril 2019</td>
        <td>Strasbourg</td>
        <td><i class="material-icons">thumb_up</i></td>
    </tr>
</table>
@endsection