@extends ('partials.layout', ['title' => 'Activités à venir'])

@section ('content')
<div class="container container-activity">
{{-- @if (1) (!$ideas->isEmpty()) [MEMBRE DU BDE] --}}
@foreach($activities as $activity)
<div class="card card__activity">
    <div class="card__header">
        <img alt="1" class="card__image" src="{{asset('storage/'.$activity->imgUrl.'')}}">
    </div>
    <div class="card__content">
        <h3 class="card__title">
            @if ($activity->recurrent == 1)
                [RECURRENT] {{$activity->name}}
            @else
                {{$activity->name}}
            @endif
        </h3>
        <div class="card__content-top">
            <span class="card__item card__date">{{$activity->date}}</span>
            <span class="card__item card__participants">{{count($activity->participates)}}</span>
            <span class="card__item card__prix">{{$activity->price}} €</span>
        </div>
        <div class="card__content-mid">
            <span class="card__description">{{$activity->description}}</span>
        </div>
        <div class="card__content-admin">
            @if($user->status = 1)
                <a class="card__list" href="{{ route('activities.list', ['id' => $activity->id]) }}">Liste des inscrits</a>
            @endif
        </div>
        <div class="card__content-bot">
            @if($activity->participates->where('user_id', $user->id)->first())
                <span>Inscrit</span>
            @else
                <a href="{{ route('activities.signup.post', ['id' => $activity->id]) }}"><button class="btn accept__btn" id="btnAccept-1" onclick="accept()">S'INSCRIRE</button></a>
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
