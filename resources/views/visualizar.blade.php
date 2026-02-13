@extends('layout.homeBase')

@section('tittle', 'Postagem')

@push('style')
<style>
    h1,
    p {
        font-family: 'Rajdhani', sans-serif;
    }
</style>
@endpush

@section('conteudo')

@livewire('visualizar-postagem', [
'postagem' => $postagem,
'likes' => $likes,
])

@endsection