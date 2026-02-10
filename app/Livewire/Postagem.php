<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Postagem as PostagemModel; // Importe o model corretamente

class Postagem extends Component
{
    public $user;
    public $postagem_id;
    public $titulo;
    public $subtitulo;
    public $categoria;
    public $conteudo;
    public $status;

    public function mount($user, $postagem)
    {
        $this->user = $user;
        $this->postagem_id = $postagem->id;

        $this->titulo = $postagem->titulo;
        $this->subtitulo = $postagem->subtitulo;
        $this->categoria = $postagem->categoria;
        $this->conteudo = $postagem->conteudo;
        $this->status = $postagem->status;
    }

    public function saveField($field, $value)
    {
        PostagemModel::where('id', $this->postagem_id)->update([
            $field => $value
        ]);
    }

    public function updatedTitulo($value) { $this->saveField('titulo', $value); }
    public function updatedSubtitulo($value) { $this->saveField('subtitulo', $value); }
    public function updatedCategoria($value) { $this->saveField('categoria', $value); }
    public function updatedConteudo($value) { $this->saveField('conteudo', $value); }

    public function render()
    {
        return view('livewire.postagem');
    }
}