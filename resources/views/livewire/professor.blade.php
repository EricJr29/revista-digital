<div class="container-fluid rounded-top shadow-lg p-0"
    style="margin-top: 25vh; min-height: calc(75vh - 68px); padding-bottom: 50px; background-color: #efefef;">

    <div class="container-fluid">
        <div class="row justify-content-center">

            <div class="col-6 col-md-4" style="margin-top: -80px;">
                <div class="card shadow-sm border-0 p-4 bg-white rounded-3 mb-4">
                    <img src="{{ $user->image ? asset('storage/' . $user->image) : asset('img/default-avatar.png') }}"
                        class="rounded-circle mx-auto img-thumbnail shadow-sm"
                        style="width: 120px; height: 120px; margin-top: -70px; object-fit: cover; border: 4px solid white;">

                    <h4 class="mt-3 fw-bold text-center" style="font-family: 'Rajdhani', sans-serif;">{{$user->name}}</h4>
                    <p class="text-center text-primary small fw-bold mt-n2">PROFESSOR</p>

                    <div class="d-flex justify-content-around mt-3">
                        <div class="text-center">
                            <i class="bi bi-file-earmark-post text-primary fs-5 d-block"></i>
                            <small class="text-muted"><strong>{{$postagens->count()}}</strong> Posts</small>
                        </div>
                        <div class="text-center">
                            <i class="bi bi-people-fill text-info fs-5 d-block"></i>
                            <small class="text-muted"><strong>{{$seguidores->count()}}</strong> Seguidores</small>
                        </div>
                        <div class="text-center">
                            <i class="bi bi-check-circle-fill text-success fs-5 d-block"></i>
                            <small class="text-muted"><strong>{{$postagens_pendentes->count()}}</strong> Pendentes</small>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        <a href="{{route('postagem')}}" class="btn btn-primary w-100 fw-bold rounded-pill shadow-sm" role='button'>
                            <i class="bi bi-plus-lg me-1"></i> Criar Postagem
                        </a>
                    </div>
                </div>

                <div class="card shadow-sm border-0 p-4 bg-white rounded-3">
                    <div class="text-start">
                        <label for="bio" class="form-label fw-bold text-dark small uppercase" style="letter-spacing: 1px;">
                            <i class="bi bi-person-lines-fill me-2 text-primary"></i>BIO DO PROFESSOR
                        </label>
                        <textarea class="form-control border-0 bg-light p-3"
                            wire:model.live="bio"
                            placeholder="Escreva algo sobre sua trajetória..."
                            rows="4"
                            style="font-size: 0.9rem; resize: none; border-radius: 12px;"></textarea>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-8 mt-4 px-4">

                @if($postagens_pendentes->count() > 0)
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold m-0 text-danger"><i class="bi bi-exclamation-circle me-2"></i>POSTAGENS A VALIDAR</h5>
                </div>

                <div class="row overflow-y-auto mb-5" style="max-height: 45vh; border-left: 4px solid #dc3545; padding-left: 15px;">
                    @foreach($postagens_pendentes as $post)
                    <div class="col-md-6 mb-4" wire:key="pending-{{ $post->id }}">

                        <a href="{{ route('postagem.validar', ['id' => $post->id]) }}" class="text-decoration-none">
                            <div class="card h-100 border-0 shadow-sm hover-shadow transition bg-white">
                                <div class="position-relative">
                                    @php
                                    $urlPendente = asset('img/default.jpg');
                                    if ($post->imagem) {
                                    $urlPendente = str_starts_with($post->imagem, 'img/')
                                    ? asset($post->imagem)
                                    : asset('storage/' . $post->imagem);
                                    } elseif ($post->categoria) {
                                    $urlPendente = asset('img/categorias/default_' . $post->categoria->nome . '.jpg');
                                    }
                                    @endphp
                                    <img src="{{ $urlPendente }}" class="card-img-top rounded-top" style="height: 120px; object-fit: cover; opacity: 0.8;">
                                    <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-2 shadow-sm">Aguardando</span>
                                </div>

                                <div class="card-body text-center">
                                    <h6 class="fw-bold text-dark mb-1">{{ Str::limit($post->titulo, 30) }}</h6>
                                    <p class="text-muted x-small mb-3" style="font-size: 0.75rem;">Enviado por: <strong>{{ $post->user->name ?? 'Aluno' }}</strong></p>

                                    <div class="d-flex justify-content-center gap-1 mt-auto">
                                        <button wire:click.prevent="aceitar({{ $post->id }})" wire:confirm="Aprovar este projeto?" class="btn btn-success btn-sm rounded-pill px-3">
                                            <i class="bi bi-check-lg"></i>
                                        </button>
                                        <button wire:click.prevent="revisao({{ $post->id }})" wire:confirm="Enviar para Revisão?" class="btn btn-warning btn-sm rounded-pill px-3">
                                            <i class="bi bi-pen"></i>
                                        </button>
                                        <button wire:click.prevent="recusar({{ $post->id }})" wire:confirm="Recusar este projeto?" class="btn btn-danger btn-sm rounded-pill px-3">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                <hr class="mb-5">
                @endif

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold m-0">MEUS PROJETOS</h5>
                    <select class="form-select border-0 shadow-sm w-25" wire:model.live="status">
                        <option value="todos">Todos</option>
                        <option value="aprovado">Aprovado</option>
                        <option value="producao">Produção</option>
                    </select>
                </div>

                <div class="row flex-grow-1 overflow-y-auto" style="height:55vh;">
                    @foreach($postagens as $post)
                    <div class="col-md-6 mb-4" wire:key="post-{{ $post->id }}">
                        <a href="{{ route('postagem.edit', ['id' => $post->id]) }}" class="text-decoration-none">
                            <div class="card h-100 border-0 shadow-sm hover-shadow transition bg-white">
                                @php
                                $urlProprio = asset('img/default.jpg');

                                if ($post->imagem) {
                                $urlProprio = str_starts_with($post->imagem, 'img/')
                                ? asset($post->imagem)
                                : asset('storage/' . $post->imagem);
                                } elseif ($post->categoria) {
                                $urlProprio = asset('img/categorias/default_' . $post->categoria->nome . '.jpg');
                                }
                                @endphp

                                <img src="{{ $urlProprio }}"
                                    class="card-img-top rounded-top"
                                    style="height: 140px; object-fit: cover;">

                                <div class="card-body d-flex flex-column justify-content-center text-center">
                                    <h5 class="fw-bold text-dark mb-1">{{ $post->titulo ?? 'Sem Título' }}</h5>
                                    <span class="badge rounded-pill px-3 mx-auto {{ $post->status == 'aprovado' ? 'bg-success-subtle text-success' : 'bg-primary-subtle text-primary' }}">
                                        {{ ucfirst($post->status) }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>