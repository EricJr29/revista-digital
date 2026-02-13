<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Postagem as PostagemModel;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Postagem extends Component
{
    use WithFileUploads;

    public $user;
    public $postagem_id;
    public $titulo;
    public $subtitulo;
    public $categoria;
    public $conteudo;
    public $status;
    public $categorias;
    public $capa;
    public $postagem;
    public $imagem;

    public function mount($user, $postagem, $categorias)
    {
        $this->user = $user;
        $this->categorias = $categorias;
        $this->postagem = $postagem;

        $this->postagem_id = $postagem->id;
        $this->titulo = $postagem->titulo;
        $this->subtitulo = $postagem->subtitulo;
        $this->categoria = $postagem->categoria_id;
        $this->conteudo = $postagem->conteudo;
        $this->status = $postagem->status;
        $this->imagem = $postagem->imagem;
    }

    public function salvarCapa()
    {
        $this->validate([
            'capa' => 'required|image|max:2048',
        ]);

        if ($this->imagem) {
            Storage::disk('public')->delete($this->imagem);
        }

        $caminho = $this->capa->store('postagens', 'public');

        $post = PostagemModel::find($this->postagem_id);

        if ($post) {
            $post->update([
                'imagem' => $caminho
            ]);

            $this->imagem = $caminho; 
            $this->postagem = $post->fresh();
            $this->reset('capa'); 

            session()->flash('message', 'Capa atualizada com sucesso!');
        }
    }

    public function saveField($field, $value)
    {
        PostagemModel::where('id', $this->postagem_id)->update([
            $field => $value
        ]);
    }

    public function finalizar()
    {
        PostagemModel::where('id', $this->postagem_id)->update([
            'status' => Auth::user()->permissao >= 2 ? 'aprovado' : 'pendente',
        ]);
        session()->flash('message', 'Projeto enviado com sucesso!');

        return redirect()->route(Auth::user()->permissao == 3 ? 'admin.dashboard' : 'profile');
    }

    public function updatedTitulo($value)
    {
        $this->saveField('titulo', $value);
    }
    public function updatedSubtitulo($value)
    {
        $this->saveField('subtitulo', $value);
    }
    public function updatedCategoria($value)
    {
        $this->saveField('categoria_id', $value);
    }
    public function updatedConteudo($value)
    {
        $this->saveField('conteudo', $value);
    }

    public function render()
    {
        return view('livewire.postagem');
    }
}
