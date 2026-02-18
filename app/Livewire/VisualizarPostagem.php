<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Like;
use App\Models\Postagem;
use App\Models\Comentario;

class VisualizarPostagem extends Component
{
    public $postagem;
    public $likes_count;
    public $seu_like = false;
    public $relacionados;
    public $comentarios;
    public $novoComentario;

    public function mount($postagem, $likes, $comentarios)
    {
        $this->postagem = $postagem;
        $this->likes_count = $likes->count();
        $this->comentarios = $comentarios;

        if (Auth::check()) {
            $this->seu_like = $likes->contains('user_id', Auth::id());
        }

        $this->relacionados = Postagem::where('status', 'aprovado')
            ->inRandomOrder()
            ->take(4)
            ->get();
    }

    public function updateLike()
    {
        if (!Auth::check()) return redirect()->route('login');

        if ($this->seu_like) {
            Like::where('user_id', Auth::id())
                ->where('postagem_id', $this->postagem->id)
                ->delete();

            $this->seu_like = false;
            $this->likes_count--;
        } else {
            Like::create([
                'user_id' => Auth::id(),
                'postagem_id' => $this->postagem->id,
            ]);

            $this->seu_like = true;
            $this->likes_count++;
        }
    }

    public function adicionarComentario()
{
    if (empty(trim($this->novoComentario))) return;

    Comentario::create([
        'postagem_id' => $this->postagem->id,
        'user_id' => Auth::id(),
        'conteudo' => $this->novoComentario
    ]);
    $this->comentarios = Comentario::where('postagem_id', $this->postagem->id)->get();

    $this->reset('novoComentario');
}

    public function render()
    {
        return view('livewire.visualizar-postagem');
    }
}
