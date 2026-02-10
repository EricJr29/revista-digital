<?php

namespace App\Livewire;

use Livewire\Component;

class Perfil extends Component
{
    public $user;
    public $seguidores;
    public $postagens;
    public $bio;

    public function mount($user, $seguidores, $postagens)
    {
        $this->user = $user;
        $this->seguidores = $seguidores;
        $this->postagens = $postagens;
        $this->bio = $user->bio;
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
