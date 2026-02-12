

<div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 hover-shadow transition">
    <div class="position-relative">
        <img src="{{ $postagem->imagem ? asset('storage/' . $postagem->imagem) : asset('img/default-postagem.jpg') }}" 
             class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $postagem->titulo }}">
        
        <span class="position-absolute top-0 end-0 m-3 badge rounded-pill 
            {{ $postagem->status == 'aprovado' ? 'bg-success' : 'bg-warning text-dark' }}">
            {{ ucfirst($postagem->status) }}
        </span>
    </div>

    <div class="card-body p-4">
        <h5 class="fw-bold text-dark mb-1">{{ $postagem->titulo ?? 'Sem título' }}</h5>
        <p class="text-muted small mb-3">{{ Str::limit($postagem->subtitulo, 60) }}</p>
        <h5 class="fw-bold text-dark mb-1">{{ $postagem->conteudo}}</h5>

        <hr class="my-3 opacity-25">

        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img src="{{ $postagem->user->image ? asset('storage/' . $postagem->user->image) : asset('img/default-avatar.png') }}" 
                     class="rounded-circle me-2" style="width: 35px; height: 35px; object-fit: cover;">
                
                <div class="d-flex flex-column">
                    <span class="fw-bold small d-block">{{ $postagem->user->name }}</span>
                    <small class="text-muted" style="font-size: 0.7rem;">{{ $postagem->created_at->diffForHumans() }}</small>
                </div>
            </div>

            <div class="d-flex align-items-center gap-1">
                <button wire:click='updateLike' class="btn btn-link p-0 text-decoration-none border-0">
                    <i class="bi {{ $seu_like ? 'bi-heart-fill text-danger' : 'bi-heart text-muted' }} fs-5"></i>
                </button>
                <span class="small fw-bold text-muted">{{ $likes_count }}</span>
            </div>
        </div>
    </div>
</div>