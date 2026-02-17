@extends('layout.homeBase')

@section('tittle', 'Home')

@section('nav_itens')
<li class="nav-item">
    <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
</li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Categorias
    </a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item fw-bold" href="{{ route('home') }}">Todas as Categorias</a></li>
        <li>
            <hr class="dropdown-divider">
        </li>
        @foreach($categorias as $categoria)
        <li><a class="dropdown-item" href="{{ route('home.get', ['id' => $categoria->id]) }}">{{$categoria->nome}}</a></li>
        @endforeach
    </ul>
</li>

@endsection

@section('navbar')

<nav class="navbar navbar-expand-lg py-1 shadow" style="background-color: #0085a5;">
    <div class="container-fluid px-lg-5">

        <div class="collapse navbar-collapse" id="subNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 flex-wrap text-white">
                @foreach($categorias as $c)
                <li class="nav-item">
                    <a class="text-white nav-link fw-semibold small pe-3 border-end border-white border-opacity-25" href="{{ route('home.get', ['id' => $c->id]) }}">{{ $c->nome }}</a>
                </li>
                @endforeach
            </ul>

            <form action="{{ route('pesquisa') }}" method="GET" class="d-flex ms-auto my-1" style="max-width: 400px;">
                <div class="input-group input-group-sm">
                    <input type="text" name="busca" class="form-control border-0" placeholder="Buscar no TechFlow..." aria-label="Buscar">
                    <button class="btn btn-primary btn-sm px-3 fw-bold" type="submit" style="background-color: #007bff;">
                        Buscar
                    </button>
                </div>
            </form>
        </div>

        <button class="navbar-toggler border-0 text-white" type="button" data-bs-toggle="collapse" data-bs-target="#subNavbar">
            <i class="bi bi-search"></i>
        </button>
    </div>
</nav>

@endsection

@section('conteudo')
<div class="container py-5" style="max-width: 1000px;">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb small">
            <li class="breadcrumb-item"><a href="/">Início</a></li>
            <li class="breadcrumb-item active">Buscar</li>
        </ol>
    </nav>

    <h2 class="fw-bold mb-4">Buscar</h2>

    <div class="card border-0 shadow-sm bg-light mb-5">
        <div class="card-body p-4">
            <form action="{{ route('pesquisa') }}" method="GET">
                <input type="text" name="busca" class="form-control form-control-lg mb-3"
                    value="{{ $termo }}" placeholder="Digite sua pesquisa...">

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="small fw-bold text-muted">CATEGORIA</label>
                        <select name="categoria" class="form-select shadow-sm">
                            <option value="">Todas as categorias</option>
                            @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ request('categoria') == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nome }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="small fw-bold text-muted">ORDENAR POR</label>
                        <select name="ordem" class="form-select shadow-sm">
                            <option value="recentes">Mais recentes</option>
                            <option value="antigos">Mais antigos</option>
                        </select>
                    </div>
                </div>

                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-primary px-4 shadow-sm">
                        <i class="bi bi-search me-2"></i>Buscar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="resultados">
        @forelse($resultados as $post)
        <div class="row mb-5 align-items-start border-bottom pb-4">
            <div class="col-md-3 mb-3 mb-md-0">
                @php
                $url = $post->imagem ? (str_starts_with($post->imagem, 'img/') ? asset($post->imagem) : asset('storage/' . $post->imagem)) : asset('img/default.jpg');
                @endphp
                <img src="{{ $url }}" class="img-fluid rounded shadow-sm" style="height: 150px; width: 100%; object-fit: cover;">
            </div>

            <div class="col-md-9">
                <h5 class="mb-1">
                    <a href="{{ route('postagem.visualizar', $post->id) }}" class="text-decoration-none fw-bold text-primary">
                        {{ $post->titulo }}
                    </a>
                </h5>
                <p class="text-muted small mb-2">{{ $post->categoria->nome ?? 'Geral' }}</p>

                <div class="mb-2 text-dark" style="font-size: 0.95rem;">
                    <strong>Autor:</strong> {{ $post->user->name }}
                </div>

                <div class="text-muted small mb-3">
                    {{ $post->created_at->format('d/m/Y') }} — {{ Str::limit($post->subtitulo, 150) }}
                </div>

                <a href="{{ route('postagem.visualizar', $post->id) }}" class="btn btn-sm btn-outline-secondary">
                    Ver detalhes
                </a>
            </div>
        </div>
        @empty
        <div class="text-center py-5">
            <i class="bi bi-emoji-frown display-4 text-muted"></i>
            <p class="mt-3 fs-5">Nenhum resultado encontrado para "{{ $termo }}".</p>
        </div>
        @endforelse
    </div>
</div>
@endsection