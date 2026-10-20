<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Galeria extends Auditoria
{
    protected $table = 'Galeria';
    protected $primaryKey = 'Id';
    protected $fillable = ['Imagen', 'IdTipoGaleria', 'Estado'];
    protected $casts = ['Estado' => 'boolean'];

    public function tipoGaleria(): BelongsTo
    {
        return $this->belongsTo(TipoGaleria::class, 'IdTipoGaleria', 'Id');
    }
}