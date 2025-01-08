@extends('layouts.main')

@section('title', 'Alex Events')

@section('content')
        {{--
            <h1>Hello World</h1>     
            <img src="img/banner.jpg" alt="">
        
                CONHECENDO O BLADE
            if(10 > 1)
                <p>A condicao e true</p>
            @endif

            <p>{{$nome}}</p>

            @if($nome == "Pedro")
                <p>O nome e Pedro</p>
            @elseif($nome == "Mateus")
                <p>O nome e {{$nome}} e ele tem {{$idade1}} anos, trabalha como {{$profissao}} </p>
            @else
                <p>O nome nao e Pedro</p>
            @endif

            @php
                $nome1='Alex';
                echo "O nome e $nome1";
        @endphp--}}
        <!-- Isto e um comentario HTML. NB: Aparece no codigo ao inspecionar -->
        {{-- Este e o comentario em blade --}}
        {{-- 
                    RESGATANDO DADOS DO BANCO
            @foreach($events as $event)
                <p>{{$event->title}}-{{$event->description}}</p>
            @endforeach
        --}}
        <div id="search-conteiner" class="col-md-12">
            <h1>Busque um evento</h1>
            <form action="/" method="get">
                <input class="form-control" id="isearch" name="search" type="text" placeholder="Procurar...">
            </form>
        </div>
        <div class="col-md-12" id="events-conteiner">
            @if($search)
                <h2>Apresentando resultados para: {{$search}}</h2>
            @else
                <h2>Proximos eventos</h2>
                <p class="subtitle">Veja os eventos dos proximos dias</p>
            @endif
            <div id="cards-conteiner" class="row">
                @foreach($events as $event)
                    <div class="card col-md-3">
                        @if(file_exists(public_path("img/events/".$event->image)) && $event->image !=null)
                            <img src="/img/events/{{$event->image}}" alt="{{$event->title}}">
                        @else
                            <img src="/img/events/5204684_2665820.jpg" alt="{{$event->title}}">                            
                        @endif 
                        <div class="card-body">
                            <p class="card-date">{{$event->date}}</p>
                            <h5 class="card-title">{{$event->title}}</h5>
                            <p class="card-participants">X Participantes</p>
                            <a href="/events/{{$event->id}}" class="btn btn-primary">Saber mais</a>
                        </div>
                    </div>
                @endforeach
                @if(count($events) == 0 && $search)
                    <p class="subtitle">Nao foi possivel econtrar resultados para {{$search}}! <a href="/">Ver todos</a></p>
                @elseif(count($events) == 0)
                    <p class="subtitle">Sem eventos disponiveis</p>
                @endif
            </div>
        </div>
@endsection