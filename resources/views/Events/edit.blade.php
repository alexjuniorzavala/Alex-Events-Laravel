@extends('layouts.main')

@section('title', 'Editando:'. $event->title)

@section('content')
    <div id="event-create-conteiner" class="col-md-6 offset-md-3">
        <h1>Editando: {{$event->title}}</h1>
        <form action="/events/update/{{$event->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="image">Imagem:</label>
                <input type="file" name="image" id="image" class="form-control-file">
                <img src="/img/events/{{$event->image}}" alt="{{$event->title}}" class="image-preview">
            </div>
            <div class="form-group">
                <label for="title">Evento:</label>
                <input type="text" name="title" id="ititle" class="form-control" value="{{$event->title}}">
            </div>
            <div class="form-group">
                <label for="date">Data do evento:</label>
                <input type="date" name="date" id="idate" class="form-control" value="{{$event->date}}">
            </div>
            <div class="form-group">
                <label for="city">Cidade:</label>
                <input type="text" name="city" id="icity" class="form-control" value="{{$event->city}}">
            </div>
            <div class="form-group">
                <label for="private">O evento e privado?</label>
                <select name="private" id="iprivate" class="form-control">
                    <option value="1">SIM</option>
                    <option value="0" {{$event->private ==0? "selected='selected'": ""}}>NAO</option>
                </select>
            </div>
            <div class="form-group">
                <label for="title">Descricao:</label>
                <textarea name="description" placeholder="O que vai acontecer no evento?" id="idescription" class="form-control">{{$event->description}}</textarea>
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" id="Cadeiras" value="Cadeiras" {{ in_array('Cadeiras', $event->items ?? []) ? 'checked' : '' }}><label for="Cadeiras">Cadeiras</label>
            </div>
            <div class="form-group">
                <label>
                <input type="checkbox" name="items[]" value="Palco" 
                {{ in_array('Palco', $event->items ?? []) ? 'checked' : '' }}>
                Palco
                </label>
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" id="Cervejas gratis" value="Cervejas gratis"{{ in_array('Cervejas gratis', $event->items ?? []) ? 'checked' : '' }}><label for="Cervejas gratis">Cervejas gratis</label>
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Open food" id="Open food" {{ in_array('Open food', $event->items ?? []) ? 'checked' : '' }}><label for="Open food">Open food</label>
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" id="Brindes" value="Brindes" {{ in_array('Brindes', $event->items ?? []) ? 'checked' : '' }}><label for="Brindes">Brindes</label>
            </div>
            <input type="submit" value="Editar Evento" class="btn btn-primary">
        </form>
    </div>
@endsection