@extends('layout.homeBase')

@section('nav_itens')
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Categorias
    </a>
    <ul class="dropdown-menu">
        @foreach($categorias as $categoria)
        <li><a class="dropdown-item" href="{{ route('home.get', ['id' => $categoria->id]) }}">{{$categoria->nome}}</a></li>
        @endforeach
    </ul>
</li>

@endsection

@section('conteudo')

<div class="container-fluid w-75">
    <div class="row g-2">
        <div class="col-8">


            <div id="TopPostagens" class="carousel slide w-100">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#TopPostagens" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#TopPostagens" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#TopPostagens" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    @foreach($postagens->take(3) as $key => $post)
                    <a href='' class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <img src="{{ asset($post->imagem ?? 'img/Categorias/default.jpg') }}" class="d-block w-100" style="height: 600px; object-fit: cover;">
                        <div class="carousel-caption d-none d-md-block">
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
        <div class="col-4 border d-flex flex-column align-items-center">

            <div class="p-2">Flex item 1</div>
            <div class="p-2">Flex item 2</div>
            <div class="p-2">Flex item 3</div>
        </div>
    </div>
</div>

<div class="container-fluid mt-5" style="width: 90%;">
    <div class="row">
        @foreach($postagens->skip(3) as $post)
        <div class="col-md-4">
            <div class="card">
                <img src="{{ asset($post->imagem ?? 'img/default.jpg') }}" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->titulo }}</h5>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>

@endsection