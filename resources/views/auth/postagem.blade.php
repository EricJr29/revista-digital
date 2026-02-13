@extends('layout.base')

@section('tittle', 'Criar Postagem')

@push('style')
<style>
    body {
        background-attachment: fixed;
        background-size: cover;
        background-position: center;
        min-height: 100vh;
        background-image: url("{{ asset('img/bg_perfil.jpg') }}");
        margin: 0;
    }
</style>
@endpush

@section('conteudo')

@livewire('postagem', [
'user' => $user,
'postagem' => $postagem,
'categorias' => $categorias,
])

@endsection