<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Visualizar extends Component
{
    public $postagem;
    public $likes_count; 
    public $seu_like = false; 

    public function mount($postagem, $likes)
    {
        $this->postagem = $postagem;
        $this->likes_count = $likes->count(); //

        if (Auth::check()) {
            $this->seu_like = $likes->contains('user_id', Auth::id());
        }
    }

    public function render()
    {
        return view('livewire.visualizar');
    }
}
