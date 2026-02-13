<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Postagem;
use App\Models\Like;

class Perfil extends Component
{
    public $user;
    public $seguidores;
    public $postagens;
    public $bio;
    public $status;
    public $todosLikes;

    public function mount($user, $seguidores, $postagens)
    {
        $this->user = $user;
        $this->seguidores = $seguidores;
        $this->postagens = $postagens;
        $this->bio = $user->bio;
        $this->status = 'todos';

        $postIds = $postagens->pluck('id');
        $this->todosLikes = Like::whereIn('postagem_id', $postIds)->get();
    }

    public function updatedStatus($value)
    {
        $query = Postagem::where('usuario_id', $this->user->id);

        if ($value !== 'todos') {
            $query->where('status', $value);
        }

        $this->postagens = $query->get();
    }

    public function updatedBio($value)
    {
        $this->user->update([
            'bio' => $value
        ]);
    }

    public function render()
    {
        return view('livewire.perfil');
    }
}
