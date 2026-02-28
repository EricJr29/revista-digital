<div class="mt-5 card shadow-sm border-0 p-4 bg-white rounded-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold m-0"><i class="bi bi-people-fill me-2"></i>USUÁRIOS DO SISTEMA</h5>
        <input type="text" class="form-control w-25 shadow-sm border-0" placeholder="Buscar usuário..." wire:model.live="search">
    </div>

    @if (session()->has('message'))
    <div class="alert alert-success small p-2">{{ session('message') }}</div>
    @endif
    @if (session()->has('error'))
    <div class="alert alert-danger small p-2">{{ session('error') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Nível Atual</th>
                    <th class="text-center">Alterar Para</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $u)
                <tr>
                    <td><strong>{{ $u->name }}</strong></td>
                    <td class="text-muted">{{ $u->email }}</td>
                    <td>
                        {{-- Match para definir a COR da badge --}}
                        @php
                        $badgeColor = match((int)$u->permissao) {
                        0 => 'bg-warning text-dark',
                        1 => 'bg-info',
                        2 => 'bg-primary',
                        3 => 'bg-danger',
                        default => 'bg-secondary',
                        };

                        $label = match((int)$u->permissao) {
                        0 => 'Pendente',
                        1 => 'Aluno',
                        2 => 'Professor',
                        3 => 'ADM',
                        default => 'Desconhecido',
                        };
                        @endphp

                        <span class="badge rounded-pill {{ $badgeColor }}">
                            {{ strtoupper($label) }}
                        </span>
                    </td>
                    <td class="text-center">
                        <div class="btn-group shadow-sm">
                            {{-- Botões para cada nível --}}
                            @foreach([1 => 'Aluno', 2 => 'Prof', 3 => 'Adm'] as $valor => $texto)
                            <button wire:click="alterarRole({{ $u->id }}, {{ $valor }})"
                                class="btn btn-sm {{ $u->permissao == $valor ? 'btn-dark active' : 'btn-outline-dark' }}">
                                {{ $texto }}
                            </button>
                            @endforeach
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>