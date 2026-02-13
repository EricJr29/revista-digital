@extends('layout.homeBase')

@section('tittle', 'Postagem')

@php
$corCategoria = match($postagem->categoria_id) {
1 => '#007bff',
2 => '#e83e8c',
3 => '#8b4513',
4 => '#28a745',
5 => '#fd7e14',
6 => '#6f42c1',
7 => '#dc3545',
8 => '#17a2b8',
default => '#6c757d'
};
@endphp

@push('style')
<style>
    h1,
    p {
        font-family: 'Rajdhani', sans-serif;
    }
    :root {
        --cor-tema: {{ $corCategoria }};
    }
</style>
@endpush

@section('conteudo')

@livewire('visualizar-postagem', [
'postagem' => $postagem,
'likes' => $likes,
])

@endsection