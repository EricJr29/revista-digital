@extends('layout.base')

@push('style')
body {
background-attachment: fixed;
background-size: cover;
background-position: center;
min-height: 100vh;
background-image: url('{{ asset('img/bg_perfil.jpg') }}');
margin: 0;
}
@endpush

@section('conteudo')

@livewire('perfil', [
    'user' => $user, 
    'seguidores' => $seguidores, 
    'postagens' => $postagens
])

@endsection