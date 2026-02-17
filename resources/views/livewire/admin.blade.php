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
                    <p class="text-center text-primary small fw-bold mt-n2">ADMIN</p>

                    <div class="d-flex justify-content-around mt-3">
                        <div class="text-center">
                            <i class="bi bi-file-earmark-post text-primary fs-5 d-block"></i>
                            <small class="text-muted"><strong>{{ $postagens->count() }}</strong> Posts</small>
                        </div>

                        <div class="text-center">
                            <i class="bi bi-people-fill text-info fs-5 d-block"></i>
                            <small class="text-muted"><strong>{{ $seguidores->count() }}</strong> Seguidores</small>
                        </div>

                        <div class="text-center">
                            <i class="bi bi-person-plus-fill text-danger fs-5 d-block"></i>
                            <small class="text-muted"><strong>{{ $avaliar->count() }}</strong> Pendentes</small>
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
                        <label class="form-label fw-bold text-dark small uppercase" style="letter-spacing: 1px;">
                            <i class="bi bi-person-lines-fill me-2 text-primary"></i>BIO DO ADMIN
                        </label>
                        <textarea class="form-control border-0 bg-light p-3"
                            wire:model.live="bio"
                            placeholder="Escreva algo..."
                            rows="4"
                            style="font-size: 0.9rem; resize: none; border-radius: 12px;"></textarea>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-8 mt-4 px-4 text-center">

                @if($avaliar->count() > 0)
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold m-0 text-danger"><i class="bi bi-person-plus-fill me-2"></i>USUÁRIOS PENDENTES</h5>
                </div>

                <div class="row mb-5" style="border-left: 4px solid #dc3545; padding-left: 15px;">
                    @foreach($avaliar as $v)
                    <div class="col-md-6 mb-3" wire:key="user-{{ $v->id }}">
                        <div class="card border-0 shadow-sm bg-white p-2">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div class="text-start">
                                    <h6 class="fw-bold mb-0 text-dark">{{ $v->name }}</h6>
                                    <small class="text-muted">{{ $v->email }}</small>
                                </div>
                                <div class="d-flex gap-1">
                                    <button wire:click="aceitar({{ $v->id }})" class="btn btn-success btn-sm rounded-circle"><i class="bi bi-check"></i></button>
                                    <button wire:click="recusar({{ $v->id }})" class="btn btn-danger btn-sm rounded-circle"><i class="bi bi-x"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <hr class="mb-5">
                @endif

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold m-0">GERENCIAR PROJETOS</h5>
                    <select class="form-select border-0 shadow-sm w-25" wire:model.live="status">
                        <option value="todos">Todos</option>
                        <option value="pendente">Pendentes</option>
                        <option value="aprovado">Aprovados</option>
                    </select>
                </div>

                <div class="row flex-grow-1 overflow-y-auto" style="height:55vh;">
                    @foreach($postagens as $post)
                    <div class="col-md-6 mb-4" wire:key="post-{{ $post->id }}">
                        <a href="{{ route('postagem.edit', ['id' => $post->id]) }}" class="text-decoration-none">
                            <div class="card h-100 border-0 shadow-sm hover-shadow transition" style="background-color: #ffffff;">

                                @php
                                $urlAdm = asset('img/default.jpg');
                                if ($post->imagem) {
                                $urlAdm = str_starts_with($post->imagem, 'img/') ? asset($post->imagem) : asset('storage/' . $post->imagem);
                                } elseif ($post->categoria) {
                                $urlAdm = asset('img/categorias/default_' . $post->categoria->nome . '.jpg');
                                }
                                @endphp

                                <img src="{{ $urlAdm }}" class="card-img-top rounded-top" style="height: 140px; object-fit: cover;">

                                <div class="card-body d-flex flex-column justify-content-center text-center">
                                    <h5 class="fw-bold text-dark mb-1">{{ $post->titulo ?? 'Sem Título' }}</h5>
                                    <p class="text-muted small mb-2">Por: <strong>{{ $post->user->name ?? 'User' }}</strong></p>

                                    <div class="mt-auto">
                                        <span class="badge rounded-pill px-3 {{ $post->status == 'aprovado' ? 'bg-success-subtle text-success' : 'bg-primary-subtle text-primary' }}">
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
</div>