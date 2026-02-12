<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Postagem;

class Perfil extends Component
{
    public $user;
    public $seguidores;
    public $postagens;
    public $bio;
    public $status;

    public function mount($user, $seguidores, $postagens)
    {
        $this->user = $user;
        $this->seguidores = $seguidores;
        $this->postagens = $postagens;
        $this->bio = $user->bio;
        $this->status = 'todos';
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
