@extends ('partials.layout', ['title' => 'Activités à venir'])

@section ('content')
<div class="container container-activity">
{{-- @if (1) (!$ideas->isEmpty()) [MEMBRE DU BDE] --}}
@foreach($activities as $activity)
<div class="card card__activity">
    <div class="card__header">
        <img alt="Image {{$activity->name}}" class="card__image" src="{{asset('storage/'.$activity->imgUrl.'')}}">
    </div>
    <div class="card__content">
        <div class="card__primary">
            <h3 class="card__title">{{$activity->name}}</h3>
            @if($user->status == 1)
            <a href="{{ route('delete.activity', ['activityId' => $activity->id]) }}">Supprimer Activité</a>
            @elseif($user->status == 2)
            <a href="{{ route('report.activity', ['activityId' => $activity->id]) }}">Signaler Activité</a>
            @endif
            <h4 class="card__subtitle">@if ($activity->recurrent == 1) Récurrent @else Ponctuel @endif</h4>
        </div>
        <div class="card__text">
            <span class="card__description">{{$activity->description}}</span>
        </div>
        <hr>
        <div class="card__datas">
            <div class="card__data">
                <h5 class="card__data-title">Date</h5>
                <span class="card__data-value card__date">{{date("d/m/Y", strtotime($activity->date))}}</span>
            </div>
            <div class="card__data">
                <h5 class="card__data-title">Participants</h5>
                <span class="card__data-value card__participants">{{count($activity->participates)}}</span>
            </div>
            <div class="card__data">
                <h5 class="card__data-title">Prix</h5>
                <span class="card__data-value card__prix">{{$activity->price}} €</span>
           </div>
        </div>
        <div class="card__actions">
            @if($activity->participates->where('user_id', $user->id)->first())
                <button class="card__btn disabled">INSCRIT</button>
            @else
                <a href="{{ route('activities.signup.post', ['id' => $activity->id]) }}"><button class="card__btn">S'INSCRIRE</button></a>
            @endif
            @if($user->status == 1)
                <a class="card__list" href="{{ route('activities.list', ['id' => $activity->id]) }}">Liste des inscrits</a>
            @endif
        </div>
    </div>
</div>
@endforeach
{{-- @else
    <p>Aucune activité à venir</p>
@endif --}}
</div>
@endsection
