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
.hover-shadow:hover {
    transform: translateY(-5px);
    box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;
    transition: all 0.3s ease;
}
@endpush

@section('tittle', 'Perfil')

@section('conteudo')

@livewire('admin', [
    'user' => $user, 
    'avaliar' => $avaliar,
    'seguidores' => $seguidores, 
    'postagens' => $postagens
])

@endsection