<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height initial-scale=1.0 maximum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#d90119" />
    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>{{ $title or 'Welcome' }} | BDE eXia.CESI</title>
</head>
<body id="body">
        <?php $i = 0; ?>
    <div style="overflow-x: auto;" id="test">
    <h1>Activité : {{ $activity->name }}</h1>
            <table>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Date Inscription</th>
                        <th>Email</th>
                        <th>Statut</th>
                    </tr>
                @foreach($activity->participates as $participant)
                <tr id="participant-{{ $i }}">
                    <td>{{$participant->user->where('id', $participant->user_id)->first()->name}}</td>
                    <td>{{$participant->user->where('id', $participant->user_id)->first()->firstname}}</td>
                    <td>{{$participant->where('user_id', $participant->user_id)->first()->created_at}}</td>
                    <td>{{$participant->user->where('id', $participant->user_id)->first()->email}}</td>
                    <td>
                        @if($participant->user->where('id', $participant->user_id)->first()->status = 0)
                        Etudiant
                        @elseif($participant->user->where('id', $participant->user_id)->first()->status = 1)
                        Membre BDE
                        @else
                        Salarié CESI
                        @endif
                    </td>
                </tr>
                    <?php $i++ ?>
                @endforeach
                </table>
    </div>
</body>
</html>