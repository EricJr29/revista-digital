<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class Admin extends Component
{
    public $user;
    public $avaliar;
    public $seguidores;
    public $postagens;
    public $bio;

    public function mount($user, $seguidores, $postagens, $avaliar)
    {
        $this->user = $user;
        $this->seguidores = $seguidores;
        $this->postagens = $postagens;
        $this->bio = $user->bio;
        $this->avaliar = $avaliar;
    }

    public function updatedBio($value)
    {
        $this->user->update([
            'bio' => $value
        ]);
    }

    public function aceitar($id)
    {

        User::where('id', $id)->update(['permissao' => 1]);

        $this->avaliar = User::where('permissao', 0)->get();

        session()->flash('message', 'Usuário aprovado com sucesso!');
    }

    public function recusar($id)
    {
        User::where('id', $id)->delete();

        $this->avaliar = User::where('permissao', 0)->get();

        session()->flash('error', 'Cadastro recusado e removido.');
    }

    public function render()
    {
        return view('livewire.admin');
    }
}
