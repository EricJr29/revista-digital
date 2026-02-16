<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Seguidor;
use Illuminate\Support\Facades\Auth;

class VisualizarPerfil extends Component
{
    public $user;
    public $postagens; 
    public $seguidoresCount;
    public $totalLikes;
    public $is_following = false;

    public function mount($user, $postagens, $seguidores, $likes)
    {
        $this->user = $user;
        $this->postagens = $postagens;
        $this->seguidoresCount = $seguidores;
        $this->totalLikes = $likes;
        $this->checkFollowing();
    }

    public function checkFollowing()
{
    if (Auth::check()) {
        $this->is_following = Seguidor::where('user_id', Auth::id())
            ->where('seguido_id', $this->user->id)
            ->exists();
    }
}

    public function follow()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if ($this->is_following) {
            Seguidor::where('user_id', Auth::id())
                ->where('seguido_id', $this->user->id)
                ->delete();
        } else {
            Seguidor::create([
                'user_id' => Auth::id(),
                'seguido_id' => $this->user->id
            ]);
        }

        $this->checkFollowing();
        $this->seguidoresCount = Seguidor::where('seguido_id', $this->user->id)->count();
    }
}
