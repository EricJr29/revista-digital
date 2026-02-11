<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Postagem as PostagemModel;
use Illuminate\Support\Facades\Auth;

class Postagem extends Component
{
    public $user;
    public $postagem_id;
    public $titulo;
    public $subtitulo;
    public $categoria;
    public $conteudo;
    public $status;
    public $categorias;

    public function mount($user, $postagem, $categorias)
    {
        $this->user = $user;
        $this->categorias = $categorias;
        $this->postagem_id = $postagem->id;

        $this->titulo = $postagem->titulo;
        $this->subtitulo = $postagem->subtitulo;
        $this->categoria = $postagem->categoria_id;
        $this->conteudo = $postagem->conteudo;
        $this->status = $postagem->status;
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
            'status' => Auth::user()->permissao >= 2 ? 'aprovado' : 'pendente' ,
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
