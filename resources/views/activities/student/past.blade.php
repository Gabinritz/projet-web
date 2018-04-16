@extends ('partials.layout', ['title' => 'Activités passées'])

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
                    <span class="card__participants">
                        {{count($activity->participates)}} @if($activity->participates->where('user_id', $user->id)->first()) | Inscrit @endif
                    </span>
                </div>
                <div class="card__content-mid">
                    <span class="card__description">
                        {{$activity->description}}
                    </span>
                </div>
                <div class="card__content-admin">
                    @if($user->status = 1)
                        <a class="card__list" href="{{ route('activities.list', ['id' => $activity->id]) }}">Liste des inscrits</a>
                    @endif
                </div>            
                {{-- <hr> FAUT FAIRE DES HR --}}
                <div class="card__content-bot">
                    <a href="{{ route('activities.focus', ['id' => $activity->id]) }}"><button class="btn accept__btn" id="btnAccept-1" onclick="accept()">DÉTAILS</button></a>
               </div>
            </div>
        </div>
    @endforeach
    {{-- @else
        <p>Aucune activité à venir</p>
    @endif --}}
</div>
@endsection
