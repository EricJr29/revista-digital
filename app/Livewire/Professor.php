<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Postagem;

class Professor extends Component
{
    public $user;
    public $postagens_pendentes;
    public $seguidores;
    public $postagens;
    public $bio;

    public function mount($user, $seguidores, $postagens, $postagens_pendentes)
    {
        $this->user = $user;
        $this->seguidores = $seguidores;
        $this->postagens = $postagens;
        $this->bio = $user->bio;
        $this->postagens_pendentes = $postagens_pendentes;
    }

    public function updatedBio($value)
    {
        $this->user->update([
            'bio' => $value
        ]);
    }

    public function aceitar($id)
    {

        $post = Postagem::find($id);

        $default = 'img/Categorias/default_' . ($post->categoria->nome) . '.jpg';

        $imagem = $post->imagem ?? $default;

        $post->update([
            'status' => 'aprovado',
            'imagem' => $imagem
        ]);

        $this->postagens_pendentes = Postagem::where('status', 'pendente')->get();

        session()->flash('message', 'Postagem aprovada com sucesso!');
    }

    public function recusar($id)
    {
        Postagem::where('id', $id)->delete();

        $this->postagens_pendentes = Postagem::where('status', 'pendente')->get();

        session()->flash('error', 'Postagem recusado e removido.');
    }

    public function revisao($id)
    {
        Postagem::where('id', $id)->update(['status' => 'revisao']);

        $this->postagens_pendentes = Postagem::where('status', 'pendente')->get();

        session()->flash('error', 'Postagem enviada para revisão.');
    }

    public function render()
    {
        return view('livewire.professor');
    }
}
