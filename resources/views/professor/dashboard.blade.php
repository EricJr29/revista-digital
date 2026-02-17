@extends('layout.base')

@section('tittle', 'Perfil')

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

    .hover-shadow:hover {
        transform: scale(1.01);
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, .175) !important;
        transition: all 0.3s ease;
    }

    .overflow-y-auto::-webkit-scrollbar {
        width: 5px;
    }
    
    .overflow-y-auto::-webkit-scrollbar-thumb {
        background: #ddd;
        border-radius: 10px;
    }
</style>
@endpush

@section('conteudo')

@livewire('professor', [
    'user' => $user, 
    'postagens_pendentes' => $postagens_pendentes,
    'seguidores' => $seguidores, 
    'postagens' => $postagens
])

@endsection