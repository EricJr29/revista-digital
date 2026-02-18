@extends('layout.homeBase')

@section('tittle', 'Minhas Conexões')

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

    /* Efeito de Vidro no Fundo */
    .glass-container {
        background-color: rgba(255, 255, 255, 0.5);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        min-height: 60vh;
    }

    .hover-row:hover {
        background-color: #f8f9fa !important;
        transition: all 0.2s ease;
    }
</style>
@endpush

@section('conteudo')
<div class="container-fluid shadow-lg p-0 glass-container h-0">
    <div class="container pt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold text-dark">
                        <i class="bi bi-people-fill me-2"></i>Seguindo
                    </h3>
                    <span class="badge bg-primary text-white px-3 py-2 rounded-pill shadow-sm">
                        {{ $segue->count() }} Conexões
                    </span>
                </div>

                <div class="card border-0 shadow-sm p-4 rounded-4 bg-white">
                    <div class="mb-3">
                        <p class="text-muted small">Gerencie as pessoas que você acompanha na plataforma.</p>
                    </div>

                    <div class="row g-2 overflow-y-auto" style="max-height: 50vh;">
                        @forelse($segue as $s)
                        @php $amigo = $s->seguido; @endphp

                        <div class="col-12">
                            <div class="d-flex align-items-center p-3 rounded-4 border bg-light hover-row">
                                <img src="{{ $amigo->image ? asset('storage/' . $amigo->image) : asset('img/default-avatar.png') }}"
                                    class="rounded-circle shadow-sm"
                                    style="width: 50px; height: 50px; object-fit: cover; border: 2px solid #fff;">

                                <div class="ms-3 flex-grow-1">
                                    <h6 class="fw-bold mb-0 text-dark">{{ $amigo->name }}</h6>
                                    <small class="text-muted">{{ Str::limit($amigo->bio ?? 'Sem bio', 50) }}</small>
                                </div>

                                <div class="d-flex gap-2">
                                    <a href="{{ route('profile.visualizar', $amigo->id) }}" class="btn btn-white btn-sm border rounded-pill px-3 shadow-sm">
                                        Perfil
                                    </a>
                                    <a href="{{ route('delete.amigo', $amigo->id) }}" class="btn btn-outline-danger btn-sm rounded-circle shadow-sm" title="Deixar de seguir">
                                        <i class="bi bi-person-x"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12 text-center py-5">
                            <i class="bi bi-people text-muted fs-1"></i>
                            <p class="text-muted mt-2">Você ainda não segue ninguém.</p>
                        </div>
                        @endforelse
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        @php
                        $rotaDestino = match(Auth::user()->permissao) {
                        3 => 'admin.dashboard',
                        2 => 'professor.dashboard',
                        1 => 'profile',
                        };
                        @endphp
                        <a href="{{ route($rotaDestino) }}" class="btn btn-primary px-5 rounded-pill shadow">
                            Voltar ao Perfil
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection