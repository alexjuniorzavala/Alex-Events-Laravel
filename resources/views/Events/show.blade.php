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
                <p class="event-city">{{$event->city}}</p>
                <p class="event-participants">{{$event->participants}}</p>
                <p class="event-owner">{{date('d/m/y', strtotime($event->date))}}</p>
                <p class="event-owner">{{$eventOwner['name']}}</p>
                <a href="#" class="btn btn-primary" id="event-submit">Confirmar Presenca</a>
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