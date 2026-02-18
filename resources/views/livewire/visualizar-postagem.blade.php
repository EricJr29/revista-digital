<div class="container-fluid py-5" style="width: 85%;">
    <div class="row ">
        <div class="col-lg-9 w-100">
            <span class="d-block fw-bold text-center mb-1" style="color: var(--cor-tema) ;">{{ $postagem->categoria->nome }}</span>
            <h1 class="display-5 fw-bold text-dark m-0 text-center">
                {{ $postagem->titulo ?? 'Sem título' }}
            </h1>

            <p class="lead fs-3 text-muted m-0 text-center">
                {{ $postagem->subtitulo }}
            </p>
            <p class="fs-5 m-0 text-center">
                <span class="d-block fw-bold text-dark">
                    <a href="{{ route('profile.visualizar', ['id' => $postagem->user->id]) }}" class="text-decoration-none text-dark">
                        Por {{ $postagem->user->name }}
                    </a>
                </span>
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

                    <div class="mt-5 pt-4 border-top">
                        <h4 class="fw-bold mb-4" style="font-family: 'Rajdhani', sans-serif;">
                            <i class="bi bi-chat-left-text me-2 text-primary"></i>Comentários
                        </h4>

                        <div class="card border-0 shadow-sm rounded-4 mb-5 bg-light">
                            <div class="card-body p-4">
                                <div class="d-flex gap-3">
                                    <img src="{{ auth()->user()->image ? asset('storage/' . auth()->user()->image) : asset('img/default-avatar.png') }}"
                                        class="rounded-circle shadow-sm" style="width: 45px; height: 45px; object-fit: cover;">

                                    <div class="w-100">
                                        <textarea
                                            wire:model.blur="novoComentario"
                                            class="form-control border-0 bg-transparent shadow-none"
                                            rows="3"
                                            placeholder="O que você achou dessa postagem?"
                                            style="resize: none;">
                                        </textarea>

                                        <div class="d-flex justify-content-end mt-2">
                                            <button
                                                wire:click="adicionarComentario"
                                                wire:loading.attr="disabled"
                                                class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">

                                                <span wire:loading.remove>Comentar</span>
                                                <span wire:loading>Enviando...</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="comments-list  overflow-y-auto" style="height: 30vh;">
                            @forelse($comentarios as $comentario)
                            <div class="d-flex gap-3 mb-4" wire:key="comment-{{ $comentario->id }}">
                                <img src="{{ $comentario->user->image ? asset('storage/' . $comentario->user->image) : asset('img/default-avatar.png') }}"
                                    class="rounded-circle shadow-sm"
                                    style="width: 40px; height: 40px; object-fit: cover;">

                                <div class="bg-white p-3 rounded-4 shadow-sm border flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <span class="fw-bold text-dark">{{ $comentario->user->name }}</span>

                                        <small class="text-muted">
                                            {{ $comentario->created_at->locale('pt_BR')->diffForHumans() }}
                                        </small>
                                    </div>

                                    <p class="text-muted m-0 small" style="font-family: 'Rajdhani', sans-serif; font-size: 1.1rem;">
                                        {{ $comentario->conteudo }}
                                    </p>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-4">
                                <i class="bi bi-chat-dots text-muted fs-2"></i>
                                <p class="text-muted mt-2">Nenhum comentário por aqui ainda. Seja o primeiro!</p>
                            </div>
                            @endforelse
                        </div>
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

        <div class="d-flex align-items-center mb-4 border-top py-3 mt-4">
            <div>
                <span class="d-block fw-bold text-dark">
                    <a href="{{ route('profile.visualizar', ['id' => $postagem->user->id]) }}" class="text-decoration-none text-dark">
                        Por {{ $postagem->user->name }}
                    </a>
                </span>
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