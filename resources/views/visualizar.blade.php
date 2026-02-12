@extends('layout.homeBase')

@section('tittle', 'Postagem')

@section('conteudo')

@livewire('visualizar-postagem', [
    'postagem' => $postagem,
    'likes' => $likes,
])

@endsection
