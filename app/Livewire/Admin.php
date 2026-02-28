<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Admin extends Component
{
    use WithFileUploads; 

    public $novaFoto;
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

    public function updatedNovaFoto()
    {
        $this->validate([
            'novaFoto' => 'image|max:2048', 
        ]);

        if ($this->user->image) {
            Storage::disk('public')->delete($this->user->image);
        }

        $caminho = $this->novaFoto->store('avatars', 'public');

        $this->user->update([
            'foto' => $caminho
        ]);
    }

    public function render()
    {
        return view('livewire.admin');
    }
}
