@extends('layout.homeBase')

@section('tittle', 'Home')

@section('nav_itens')
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

@section('conteudo')

<div class="container-fluid w-75">
    <div class="row w-100 align-items-stretch">

        <div class="col-lg-8">
            <div id="TopPostagens" class="carousel slide shadow-sm rounded-4 overflow-hidden">
                <div class="carousel-indicators">
                    @foreach($postagens->take(3) as $key => $post)
                    <button type="button" data-bs-target="#TopPostagens" data-bs-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}" aria-current="{{ $key == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $key + 1 }}"></button>
                    @endforeach
                </div>

                <div class="carousel-inner">
                    @foreach($postagens->take(3) as $key => $post)
                    <a href="{{ route('postagem.visualizar', ['id' => $post->id]) }}" class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <img src="{{ asset($post->imagem ?? 'img/Categorias/default.jpg') }}" class="d-block w-100" style="height: 400px; object-fit: cover;">
                        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded-3">
                            <h5>{{ $post->titulo }}</h5>
                            <p>{{ $post->subtitulo }}</p>
                        </div>
                    </a>
                    @endforeach
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#TopPostagens" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#TopPostagens" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100">
                <h2 class="fs-4 text-primary fw-bold mb-4 d-flex align-items-center">
                    <i class="bi bi-graph-up-arrow me-2"></i> Estatísticas 2026
                </h2>

                <div class="d-flex flex-column gap-4">
                    <div class="d-flex align-items-center">
                        <div class="icon-box bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px; min-width: 45px;">
                            <i class="bi bi-file-earmark-post fs-5"></i>
                        </div>
                        <div>
                            <span class="d-block fw-bold fs-5">{{ $postagens->count() }}</span>
                            <small class="text-muted">Postagens Realizadas</small>
                        </div>
                    </div>

                    <div class="pe-2" style="max-height: 250px; overflow-y: auto;">
                        @foreach($categorias as $categoria)
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-box bg-primary-subtle text-primary rounded-pill d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; min-width: 40px;">
                                <span class="fw-bold small">{{ $postagens->where('categoria_id', $categoria->id)->count() }}</span>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold fs-6">{{ $categoria->nome }}</h6>
                                <small class="text-muted">Projetos realizados</small>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="container-fluid mt-5" style="width: 90%;">
    <div class="row">
        @foreach($postagens->skip(3) as $post)
        <div class="col-md-4">
            <a href="{{ route('postagem.visualizar', ['id' => $post->id]) }}" class="card">
                <img src="{{ asset($post->imagem ?? 'img/default.jpg') }}" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->titulo }}</h5>
                </div>
            </a>
        </div>
        @endforeach
    </div>

</div>

@endsection