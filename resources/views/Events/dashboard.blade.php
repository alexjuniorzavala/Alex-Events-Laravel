@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
    <div class="col-md-10 offset-md-1 dashboard-title-conteiner">
        <h1>Meus Eventos</h1>
    </div>
    <div class="col-md-10 offset-md-1 dashboard-title-conteiner">
        @if(count($events) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Participantes</th>
                        <th scope="col">Acoes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                        <tr>
                            <td>{{$loop->index + 1}}</td>
                            <td>{{$event->title}}</td>
                            <td>0</td>
                            <td><a href="#">Editar</a><a href="#">Deletar</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Voce nao tem eventos <a href="/events/create">Criar evento</a></p>
        @endif
    </div>

@endsection