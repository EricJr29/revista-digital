<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Postagem extends Model
{
    protected $table = 'postagens';

    protected $fillable = [
        'usuario_id',
        'categoria_id',
        'status',
        'titulo',
        'conteudo',
        'imagem',
    ];
    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
