<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class GerenciarUsuarios extends Component
{
    public $search = '';

    public function alterarRole($userId, $novoRole)
    {
        if ($userId == Auth::id()) {
            session()->flash('error', 'Você não pode alterar suas próprias permissões.');
            return;
        }

        $user = User::find($userId);
        $user->update(['role' => $novoRole]);

        session()->flash('message', "Permissão de {$user->name} atualizada!");
    }

    public function render()
    {
        return view('livewire.gerenciar-usuarios', [
            'usuarios' => User::where('id', '!=', Auth::id())
                ->where('name', 'like', '%' . $this->search . '%')
                ->get()
        ]);
    }
}
