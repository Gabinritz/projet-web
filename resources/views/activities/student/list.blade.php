@extends ('partials.layout', ['title' => 'Activités à venir'])

@section ('content')
<div class="container" style="text-align: center; margin-top: 2rem;">
        @if ($activity->participates) {{-- [DONNEES DANS IDEES] --}}
            <?php $i = 0; ?>
            <div class="card__content-bot" style="display: flex; justify-content : space-arspace-beetwen;">
                <a href="{{ route('list.csv', ['activity' => $activity->id]) }}"><button class="btn accept__btn" id="btnAccept-1" onclick="accept()">Télécharger la liste au format CSV</button></a>
                <a href="{{ route('list.pdf', ['activity' => $activity->id]) }}"><button class="btn accept__btn" id="btnAccept-1" onclick="accept()">Télécharger la liste au format PDF</button></a>
            </div>
            <div style="overflow-x: auto;" id="test">
                <table>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Date Inscription</th>
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
        @else {{-- [PAS DE DONNEES] --}}
            <p>Aucun participant pour cette activité</p>
        @endif
@endsection