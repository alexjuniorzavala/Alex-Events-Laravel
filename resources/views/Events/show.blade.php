@extends('layouts.main')

@section('title', $event->title)

@section('content')
    <div class="col-md-10 offset-md-1">
        <div class="row">
            <div id="image-conteiner" class=" col-md-6">
                <img src="/img/events/{{$event->image}}" class="img-fluid" alt="{{$event->title}}">
            </div>
            <div id="info-conteiner" class="col-md-6">
                <h1>{{$event->title}}</h1>
                <div class="event-info">
                    <p class="event-city"><ion-icon  name="location-outline"></ion-icon>  {{$event->city}}</p>
                </div>
                <div class="event-info">
                    <p class="event-participants"><ion-icon  name="people-outline"></ion-icon> Participantes: {{count($event->users)}}</p>
                </div>
                <div class="event-info">
                    <p class="event-owner"><ion-icon  name="star-outline"></ion-icon>  {{$eventOwner['name']}}</p>
                </div>
                <p class="event-private"> Privado:{{$event->private? 'Sim':'Nao'}}</p>
                <p class="event-date">{{date('d/m/y', strtotime($event->date))}}</p>
                @if(!$hasUserJoined)                 
                    <form action="/event/join/{{$event->id}}"method="post">
                        @csrf
                        <a href="/event/join/{{$event->id}}" 
                            class="btn btn-primary" 
                            id="event-submit"
                            onclick=
                            "event.preventDefault();
                            this.closest('form').submit();">
                            Confirmar Presenca
                        </a>
                    </form>
                @else
                    <p class="alreade-joined-msg">Voce ja esta participando do evento!</p>
                @endif
                <h3>O evento conta com:</h3>
                <ul id="items-list">
                    @foreach($event->items as $items)
                        <li>{{$items}}</li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-12" id="description-conteiner">
                <h3>Sobre o evento:</h3>
                <p class="event-description">{{$event->description}}</p>
            </div>
        </div>
    </div>
@endsection