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
        <h3 class="card__title">{{$activity->name}}</h3>
        <div class="card__content-top">
            <span class="card__date">{{$activity->date}}</span>
            <span class="card__participants">{{count($activity->participates)}}</span>
        </div>
        <div class="card__content-mid">
            <span class="card__description">
                {{$activity->description}}
            </span>
        </div>
        <div class="card__content-bot">
            @if($activity->participates->where('user_id', $user->id)->first())
                <span>Inscrit</span>
            @else
                <a href="{{ route('activities.signup.post', ['id' => $activity->id]) }}"><button class="btn accept__btn" id="btnAccept-1" onclick="accept()">S'INSCRIRE</button></a>
            @endif
            @if($user->status = 1)
                <a href="{{ route('activities.list', ['id' => $activity->id]) }}"><button class="btn accept__btn" id="btnAccept-1" onclick="accept()">LISTE INSCRITS</button></a></td>
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
