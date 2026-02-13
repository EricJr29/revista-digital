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


<div class="container-fluid  py-5" style="width: 85%;">

    <div class="row ">
        <div class="col-lg-9 w-100">
            <span class="d-block fw-bold text-center mb-1" style="color: {{$corCategoria}} ;">{{ $postagem->categoria->nome }}</span>
            <h1 class="display-5 fw-bold text-dark m-0 text-center">
                {{ $postagem->titulo ?? 'Sem título' }}
            </h1>

            <p class="lead fs-3 text-muted m-0 text-center">
                {{ $postagem->subtitulo }}
            </p>
            <p class="fs-5  m-0 text-center">
                <span class="d-block fw-bold text-dark">Por {{ $postagem->user->name }}</span>
                <small class="text-muted">
                    {{ $postagem->created_at->locale('pt_BR')->diffForHumans() }}
                </small>
            </p>

            <hr class="my-5">

            @php
            $finalUrl = str_starts_with($postagem->imagem, 'img/')
            ? asset($postagem->imagem)
            : asset('storage/' . $postagem->imagem);
            @endphp

            <div class="row g-4">
                <div class="col-lg-9">
                    <div class="mb-4 w-100">
                        <img src="{{ $finalUrl }}" class="img-fluid rounded-3 shadow-sm w-100" style="max-height: 70vh; object-fit: cover;" alt="{{ $postagem->titulo }}">
                        <p class="text-muted mt-2 small">
                            {{ $postagem->titulo }}
                        </p>
                        <hr>
                    </div>

                    <div class="text-dark lh-lg text-break" style="font-size: 1.25rem; text-align: justify; font-family: 'Rajdhani', sans-serif;">
                        {!! nl2br(e($postagem->conteudo)) !!}
                    </div>
                </div>

                <div class="col-lg-3 border-start ps-lg-4">
                    <h4 class="fw-bold mb-4 text-primary" style="font-family: 'Rajdhani', sans-serif;">
                        VEJA TAMBÉM
                    </h4>

                    @forelse($relacionados as $item)
                    <div class="mb-4">
                        <a href="{{ route('postagem.visualizar', $item->id) }}" class="text-decoration-none group">
                            @php
                            $imgRelacionado = str_starts_with($item->imagem, 'img/')
                            ? asset($item->imagem)
                            : asset('storage/' . $item->imagem);
                            @endphp
                            <img src="{{ $imgRelacionado }}" class="img-fluid rounded-2 mb-2 shadow-sm" style="height: 120px; width: 100%; object-fit: cover;">

                            <h6 class="text-dark fw-bold mb-1" style="font-family: 'Rajdhani', sans-serif; line-height: 1.2;">
                                {{ Str::limit($item->titulo, 50) }}
                            </h6>
                            <small class="text-muted small">
                                {{ $item->created_at->locale('pt_BR')->diffForHumans() }}
                            </small>
                        </a>
                        <hr class="opacity-25">
                    </div>
                    @empty
                    <p class="text-muted small">Nenhuma outra postagem.</p>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center mb-4 border-top py-3">
            <div>
                <span class="d-block fw-bold text-dark">Por {{ $postagem->user->name }}</span>
                <small class="text-muted">
                    {{ $postagem->created_at->locale('pt_BR')->diffForHumans() }}
                </small>
            </div>

            <div class="ms-auto d-flex align-items-center gap-2">
                <button wire:click='updateLike' class="btn btn-link p-0 text-decoration-none border-0">
                    <i class="bi {{ $seu_like ? 'bi-heart-fill text-danger' : 'bi-heart text-muted' }} fs-4"></i>
                </button>
                <span class="fw-bold text-muted">{{ $likes_count }}</span>
            </div>
        </div>
    </div>
</div>