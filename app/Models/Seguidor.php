<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Seguidor extends Model
{
  protected $table = 'seguidores';

  protected $fillable = [
    'user_id',
    'seguido_id'
  ];

  public function seguido(): BelongsTo
  {
    return $this->belongsTo(User::class, 'seguido_id');
  }
}
