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
                            <i class="bi bi-heart-fill text-danger fs-5 d-block"></i>
                            <small class="text-muted"><strong>{{$todosLikes->count()}}</strong> Likes</small>
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
                            <i class="bi bi-person-lines-fill me-2 text-primary"></i>SOBRE MIM
                        </label>
                        <textarea class="form-control border-0 bg-light p-3"
                            wire:model.live="bio"
                            placeholder="Conte um pouco sobre você..."
                            rows="4"
                            style="font-size: 0.9rem; resize: none; border-radius: 12px;"></textarea>

                        <div class="mt-3">
                            <small class="text-muted" style="font-size: 0.75rem;">
                                Sua bio ajuda outros alunos a conhecerem seus interesses.
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-8 mt-4 px-4 text-center">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold m-0">PROJETOS</h5>
                    <select class="form-select border-0 shadow-sm w-25" wire:model.live="status">
                        <option value="todos">Todos</option>
                        <option value="producao">Produção</option>
                        <option value="aprovado">Aprovado</option>
                        <option value="pendente">Pendente</option>
                        <option value="revisao">Revisão</option>
                    </select>
                </div>

                <div class="row flex-grow-1 overflow-y-auto" style="height:55vh;">
                    @foreach($postagens as $post)
                    <div class="col-md-6 mb-4" wire:key="post-{{ $post->id }}">
                        <a href="{{ $post->status == 'aprovado' ? route('postagem.visualizar', ['id' => $post->id]) : route('postagem.edit', ['id' => $post->id]) }}" class="text-decoration-none">
                            <div class="card h-100 border-0 shadow-sm hover-shadow transition" style="min-height: 200px; background-color: #ffffff;">
                                @php
                                $urlPerfil = asset('img/default.jpg');
                                if ($post->imagem) {
                                $urlPerfil = str_starts_with($post->imagem, 'img/')
                                ? asset($post->imagem)
                                : asset('storage/' . $post->imagem);
                                } elseif ($post->categoria) {
                                $urlPerfil = asset('img/categorias/default_' . $post->categoria->nome . '.jpg');
                                }
                                @endphp

                                <img src="{{ $urlPerfil }}"
                                    class="card-img-top rounded-top"
                                    style="height: 140px; object-fit: cover;"
                                    alt="{{ $post->titulo }}">

                                <div class="card-body d-flex flex-column justify-content-center text-center">
                                    <h5 class="fw-bold text-dark mb-1">{{ $post->titulo ?? 'Projeto Sem Título' }}</h5>
                                    <p class="text-muted small">{{ Str::limit($post->subtitulo, 50) }}</p>

                                    <div class="mt-auto">
                                        {{-- Cores de badge mais suaves para combinar com o fundo --}}
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