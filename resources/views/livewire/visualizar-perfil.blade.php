<div class="container-fluid rounded-top shadow-lg p-0"
    style="margin-top: 25vh; min-height: calc(75vh - 68px); padding-bottom: 50px; background-color: #efefef;">

    <div class="container-fluid">
        <div class="row justify-content-center">

            <div class="col-12 col-md-4" style="margin-top: -80px;">
                <div class="card shadow-sm border-0 p-4 bg-white rounded-3 mb-4">
                    <img src="{{ $user->image ? asset('storage/' . $user->image) : asset('img/default-avatar.png') }}"
                        class="rounded-circle mx-auto img-thumbnail shadow-sm"
                        style="width: 120px; height: 120px; margin-top: -70px; object-fit: cover; border: 4px solid white;">

                    <h4 class="mt-3 fw-bold text-center" style="font-family: 'Rajdhani', sans-serif;">{{ $user->name }}</h4>

                    <div class="d-flex justify-content-around mt-3">
                        <div class="text-center">
                            <i class="bi bi-file-earmark-post text-primary fs-5 d-block"></i>
                            <small class="text-muted"><strong>{{ $postagens->count() }}</strong> Posts</small>
                        </div>
                        <div class="text-center">
                            <i class="bi bi-people-fill text-info fs-5 d-block"></i>
                            <small class="text-muted"><strong>{{ $seguidoresCount }}</strong> Seguidores</small>
                        </div>
                        <div class="text-center">
                            <i class="bi bi-heart-fill text-danger fs-5 d-block"></i>
                            <small class="text-muted"><strong>{{$totalLikes}}</strong> Likes</small>
                        </div>
                    </div>
                    

                    <div class="d-flex justify-content-center mt-4">
                        @if(Auth::id() !== $user->id)
                            <button wire:click="follow" 
                                    class="btn {{ $is_following ? 'btn-outline-primary' : 'btn-primary' }} w-100 fw-bold rounded-pill shadow-sm">
                                <i class="bi {{ $is_following ? 'bi-person-check-fill' : 'bi-person-plus-fill' }} me-1"></i>
                                {{ $is_following ? 'Seguindo' : 'Seguir' }}
                            </button>
                        @else
                            <a href="{{ route('profile') }}" class="btn btn-secondary w-100 fw-bold rounded-pill shadow-sm">
                                <i class="bi bi-gear me-1"></i> Editar Meu Perfil
                            </a>
                        @endif
                    </div>
                </div>

                <div class="card shadow-sm border-0 p-4 bg-white rounded-3">
                    <div class="text-start">
                        <label class="form-label fw-bold text-dark small uppercase" style="letter-spacing: 1px;">
                            <i class="bi bi-person-lines-fill me-2 text-primary"></i>SOBRE {{ strtoupper($user->name) }}
                        </label>
                        <div class="bg-light p-3 rounded-3 text-muted" style="font-size: 0.9rem; min-height: 100px;">
                            {{ $user->bio ?? 'Este usuário ainda não escreveu uma bio.' }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-8 mt-4 px-4 text-center">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold m-0">PROJETOS DE {{ strtoupper($user->name) }}</h5>
                </div>

                <div class="row flex-grow-1 overflow-y-auto" style="height:55vh;">
                    @foreach($postagens as $post)
                        <div class="col-md-6 mb-4" wire:key="post-{{ $post->id }}">
                            <a href="{{ route('postagem.visualizar', ['id' => $post->id]) }}" class="text-decoration-none">
                                <div class="card h-100 border-0 shadow-sm hover-shadow transition" style="min-height: 200px; background-color: #ffffff;">
                                    @php
                                        $urlCapa = $post->imagem ? (str_starts_with($post->imagem, 'img/') ? asset($post->imagem) : asset('storage/' . $post->imagem)) : asset('img/default.jpg');
                                    @endphp

                                    <img src="{{ $urlCapa }}" class="card-img-top rounded-top" style="height: 140px; object-fit: cover;">

                                    <div class="card-body text-center">
                                        <h5 class="fw-bold text-dark mb-1">{{ $post->titulo }}</h5>
                                        <p class="text-muted small">{{ Str::limit($post->subtitulo, 40) }}</p>
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