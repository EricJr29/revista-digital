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
                                    wire:model.live.debounce.500ms="titulo">
                            </div>

                            <div class="col-md-8">
                                <label class="form-label fw-bold">Subtítulo</label>
                                <input type="text" class="form-control border-0 shadow-sm"
                                    placeholder="Um resumo rápido"
                                    wire:model.live.debounce.500ms="subtitulo">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold">Categoria</label>
                                <select class="form-select border-0 shadow-sm" wire:model.live="categoria">
                                    <option value="">Selecione...</option>
                                    <option value="tecnologia">Tecnologia</option>
                                    <option value="design">Design</option>
                                    <option value="negocios">Negócios</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold">Conteúdo da Postagem</label>
                                <textarea class="form-control border-0 shadow-sm" rows="8"
                                    placeholder="Escreva aqui sua ideia..."
                                    wire:model.live.debounce.1000ms="conteudo"></textarea>
                            </div>

                            <div class="col-12 mt-4">
                                <div class="border border-2 border-dashed rounded-3 p-5 text-center text-muted">
                                    <i class="bi bi-image fs-1"></i>
                                    <p class="mb-0">Clique para subir uma capa (Em breve)</p>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4 gap-2">
                            <a href="{{ route('profile') }}" class="btn btn-outline-secondary px-4 rounded-pill">Sair e Salvar</a>
                            <button type="button" class="btn btn-primary px-5 rounded-pill shadow"
                                wire:loading.attr="disabled">
                                <span wire:loading.remove>Finalizar Projeto</span>
                                <span wire:loading>Salvando...</span>
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>