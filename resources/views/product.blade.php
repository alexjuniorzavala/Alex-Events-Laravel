@extends('layouts.main')

@section('title', 'Produtos teste')

@section('content')
    <h1>Produtos teste</h1>

    @if($id != null)
        <p>Exibindo o produto id: {{$id}}</p>
    @endif
@endsection