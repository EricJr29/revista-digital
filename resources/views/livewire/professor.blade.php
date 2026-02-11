<div class="container-fluid bg-white rounded-top shadow-lg p-0"
    style="margin-top: 25vh; min-height: calc(75vh - 68px); padding-bottom: 50px;">

    <div class="container-fluid">
        <div class="row justify-content-center">

            <div class="col-6 col-md-4 " style="margin-top: -80px;">
                <div class="card shadow border-0 text-center p-3 bg-slate-200 rounded-2">

                    <img src="{{ $user->image ? asset('storage/' . $user->image) : asset('img/default-avatar.png') }}"
                        class="rounded-circle mx-auto img-thumbnail shadow-sm"
                        style="width: 120px; height: 120px; margin-top: -60px; object-fit: cover;">
                    <h4 class="mt-3 fw-bold">{{$user->name}}</h4>
                    <div class="d-flex justify-content-around text-muted sm mt-2">
                        <span><strong>{{$postagens->count()}}</strong> Postagens</span>
                        <span><strong>{{$seguidores->count()}}</strong> Seguidores</span>
                    </div>
                    <div class="d-flex justify-content-center mt-4 sm">
                        <a href="{{route('postagem')}}" class="btn btn-primary w-75" role='button'>+ Postagem</a>
                    </div>
                    <div class="mb-3 mt-4 text-start">
                        <label for="bio" class="form-label fw-bold fs-5">Bio</label>
                        <input type="text" class="form-control" wire:model.live="bio" placeholder="Escreva sua bio...">
                    </div>
                </div>
            </div>

            <div class=" col-sm-6 col-md-8 mt-4 px-4 text-center">
                <div class="mb-4">
                    <h5 class="fw-bold text-uppercase">Postagens a Validar</h5>
                </div>

                <div class="row">
                    @foreach($postagens_pendentes as $post)
                    <div class="col-md-6 mb-4" wire:key="post-{{ $post->id }}">
                        <a href="{{ route('postagem.validar', ['id' => $post->id]) }}" class="text-decoration-none">
                            <div class="card h-100 border-0 shadow-sm hover-shadow transition" style="min-height: 200px;">
                                @if($post->imagem)
                                <img src="{{ asset('storage/' . $post->imagem) }}" class="card-img-top rounded-top" style="height: 120px; object-fit: cover;">
                                @elseif($post->categoria)
                                <img src="{{ asset('img/categorias/default_' . $post->categoria->nome . '.jpg') }}"
                                    class="card-img-top rounded-top"
                                    style="height: 120px; object-fit: cover;"
                                    alt="{{ $post->categoria->nome }}">
                                @else
                                <img src="{{ asset('img/default.jpg') }}" class="card-img-top rounded-top" style="height: 120px; object-fit: cover;">
                                @endif

                                <div class="card-body d-flex flex-column justify-content-center text-center">
                                    <h5 class="fw-bold text-dark">{{ $post->titulo ?? 'Projeto Sem Título' }}</h5>
                                    <p class="text-muted small">{{ Str::limit($post->subtitulo, 50) }}</p>

                                    <div class="mt-auto">
                                        <span class="badge bg-primary-subtle text-primary rounded-pill px-3">
                                            {{ ucfirst($post->status) }}
                                        </span>
                                    </div>
                                    <div class="d-flex justify-content-center gap-2 mt-3">
                                        <button wire:click.prevent="aceitar({{ $post->id }})"
                                        wire:confirm="Tem certeza que deseja aceitar esta postagem?"
                                            class="btn btn-success btn-sm rounded-pill px-3">
                                            <i class="bi bi-check-lg"></i> Aprovar
                                        </button>

                                        <button wire:click.prevent="recusar({{ $post->id }})"
                                            wire:confirm="Tem certeza que deseja recusar esta postagem?"
                                            class="btn btn-danger btn-sm rounded-pill px-3">
                                            <i class="bi bi-x-lg"></i> Recusar
                                        </button>
                                        <button wire:click.prevent="revisao({{ $post->id }})"
                                            class="btn btn-warning btn-sm rounded-pill px-3">
                                            <i class="bi bi-pen-fill"></i> Revisar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                <div class="mb-4">
                    <h5 class="fw-bold">PROJETOS</h5>
                </div>
                @foreach($postagens as $post)
                <div class="col-md-6 mb-4" wire:key="post-{{ $post->id }}">
                    <a href="{{ route('postagem.edit', ['id' => $post->id]) }}" class="text-decoration-none">
                        <div class="card h-100 border-0 shadow-sm hover-shadow transition" style="min-height: 200px;">
                            @if($post->imagem)
                            <img src="{{ asset('storage/' . $post->imagem) }}" class="card-img-top rounded-top" style="height: 120px; object-fit: cover;">
                            @elseif($post->categoria)
                            <img src="{{ asset('img/categorias/default_' . $post->categoria->nome . '.jpg') }}"
                                class="card-img-top rounded-top"
                                style="height: 120px; object-fit: cover;"
                                alt="{{ $post->categoria->nome }}">
                            @else
                            <img src="{{ asset('img/default.jpg') }}" class="card-img-top rounded-top" style="height: 120px; object-fit: cover;">
                            @endif

                            <div class="card-body d-flex flex-column justify-content-center text-center">
                                <h5 class="fw-bold text-dark">{{ $post->titulo ?? 'Projeto Sem Título' }}</h5>
                                <p class="text-muted small">{{ Str::limit($post->subtitulo, 50) }}</p>

                                <div class="mt-auto">
                                    <span class="badge bg-primary-subtle text-primary rounded-pill px-3">
                                        {{ ucfirst($post->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</div>