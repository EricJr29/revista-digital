@php

$rotaDestino = match(Auth::user()->permissao) {
3 => 'admin.dashboard',
2 => 'professor.dashboard',
1 => 'profile',
};
$bloqueado = !in_array($status, ['producao', 'revisao']);

@endphp

<div class="container-fluid shadow-lg p-0"
    style="background-color: rgba(255, 255, 255, 0.5); backdrop-filter: blur(10px);">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold">
                        <i class="bi bi-pencil-square me-2"></i>Editando Projeto
                    </h3>
                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                        Status: {{ $status }}
                    </span>
                </div>

                <div class="card border-0 shadow-sm p-4 rounded-4 bg-light">
                    <form>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label fw-bold">Título do Projeto</label>
                                <input type="text" class="form-control form-control-lg border-0 shadow-sm"
                                    placeholder="Dê um nome ao seu projeto..."
                                    wire:model.live.debounce.500ms="titulo"
                                    {{ $bloqueado ? 'disabled' : '' }}>
                            </div>

                            <div class="col-md-8">
                                <label class="form-label fw-bold">Subtítulo</label>
                                <input type="text" class="form-control border-0 shadow-sm"
                                    placeholder="Um resumo rápido"
                                    wire:model.live.debounce.500ms="subtitulo"
                                    {{ $bloqueado ? 'disabled' : '' }}>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold">Categoria</label>
                                <select class="form-select border-0 shadow-sm" wire:model.live="categoria" {{ $bloqueado ? 'disabled' : '' }}>
                                    <option value="">Selecione...</option>
                                    @foreach($categorias as $p)
                                    <option value="{{$p->id}}">{{$p->nome}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold">Conteúdo da Postagem</label>
                                <textarea class="form-control border-0 shadow-sm" rows="8"
                                    placeholder="Escreva aqui sua ideia..."
                                    wire:model.live.debounce.1000ms="conteudo"
                                    {{ $bloqueado ? 'disabled' : '' }}></textarea>
                            </div>

                            <div class="col-12 mt-4">
                                <div class="card border-0 shadow-sm overflow-hidden rounded-4">
                                    <div class="card-header bg-white border-0 py-3">
                                        <h6 class="mb-0 fw-bold text-muted">Capa do Projeto</h6>
                                    </div>

                                    <div class="card-body p-4 bg-light">
                                        @if ($capa)
                                        <div class="text-center">
                                            <div class="position-relative d-inline-block">
                                                <img src="{{ $capa->temporaryUrl() }}" class="img-fluid rounded-3 shadow" style="max-height: 250px; border: 3px solid #fff;">
                                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
                                                    Novo
                                                </span>
                                            </div>

                                            <div class="mt-3 d-flex justify-content-center gap-2">
                                                <button type="button" wire:click="salvarCapa" class="btn btn-success px-4 rounded-pill fw-bold shadow-sm">
                                                    <i class="bi bi-cloud-arrow-up-fill me-2"></i>Salvar Nova Capa
                                                </button>
                                                <button type="button" wire:click="$set('capa', null)" class="btn btn-light px-4 rounded-pill border">
                                                    Cancelar
                                                </button>
                                            </div>
                                        </div>

                                        @elseif($imagem)
                                        <div class="text-center">
                                            <img src="{{ asset('storage/' . $imagem) }}" class="img-fluid rounded-3 shadow-sm mb-3" style="max-height: 200px;">
                                            <div class="d-block">
                                                <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3" onclick="document.getElementById('inputCapa').click()">
                                                    <i class="bi bi-arrow-left-right me-1"></i> Alterar Imagem
                                                </button>
                                            </div>
                                        </div>

                                        @else
                                        <div class="border-dashed rounded-4 p-5 text-center text-muted"
                                            style="border: 2px dashed #cbd5e0; cursor: pointer; transition: all 0.3s;"
                                            onmouseover="this.style.backgroundColor='#edf2f7'"
                                            onmouseout="this.style.backgroundColor='transparent'"
                                            onclick="document.getElementById('inputCapa').click()">

                                            <i class="bi bi-image-fill fs-1 text-secondary"></i>
                                            <p class="mt-2 fw-medium">Nenhuma capa definida</p>
                                            <span class="btn btn-sm btn-primary rounded-pill px-4">Selecionar Foto</span>
                                        </div>
                                        @endif

                                        <input {{ $bloqueado ? 'disabled' : '' }} type="file" id="inputCapa" wire:model.live="capa" class="d-none" accept="image/*">

                                        <div wire:loading wire:target="capa" class="mt-3 text-center">
                                            <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
                                            <span class="ms-2 text-primary fw-bold small">Processando arquivo...</span>
                                        </div>

                                        @error('capa')
                                        <div class="alert alert-danger d-flex align-items-center mt-3 mb-0 py-2">
                                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                            <span class="small">{{ $message }}</span>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4 gap-2">
                            <a href="{{ route($rotaDestino) }}" class="btn btn-outline-secondary px-4 rounded-pill">Sair e Salvar</a>
                            @if(!$bloqueado)
                            <button type="button" class="btn btn-primary px-5 rounded-pill shadow"
                                wire:click="finalizar"
                                wire:loading.attr="disabled">
                                <span wire:loading.remove>Finalizar Projeto</span>
                                <span wire:loading>Salvando...</span>
                            </button>
                            @else
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle"></i> Este projeto está em modo de leitura (Status: {{ ucfirst($status) }}).
                            </div>
                            @endif
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>