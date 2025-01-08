@extends('layouts.main')

@section('title', 'Criar Evento')

@section('content')
    <div id="event-create-conteiner" class="col-md-6 offset-md-3">
        <h1>Crie o seu evento</h1>
        <form action="/events" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="image">Imagem:</label>
                <input type="file" name="image" id="image" class="form-control-file">
            </div>
            <div class="form-group">
                <label for="title">Evento:</label>
                <input type="text" name="title" id="ititle" class="form-control">
            </div>
            <div class="form-group">
                <label for="date">Data do evento:</label>
                <input type="date" name="date" id="idate" class="form-control">
            </div>
            <div class="form-group">
                <label for="city">Cidade:</label>
                <input type="text" name="city" id="icity" class="form-control">
            </div>
            <div class="form-group">
                <label for="private">O evento e privado?</label>
                <select name="private" id="iprivate" class="form-control">
                    <option value="1">SIM</option>
                    <option value="0">NAO</option>
                </select>
            </div>
            <div class="form-group">
                <label for="title">Descricao:</label>
                <textarea name="description" placeholder="O que vai acontecer no evento?" id="idescription" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" id="Cadeiras" value="Cadeiras"><label for="Cadeiras">Cadeiras</label>
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" id="Palco" value="Palco"><label for="Palco">Palco</label>
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" id="Cervejas gratis" value="Cervejas gratis"><label for="Cervejas gratis">Cervejas gratis</label>
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Open food" id="Open food"><label for="Open food">Open food</label>
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" id="Brindes" value="Brindes"><label for="Brindes">Brindes</label>
            </div>
            <input type="submit" value="Criar Evento" class="btn btn-primary">
        </form>
    </div>
@endsection