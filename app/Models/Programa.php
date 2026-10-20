<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Programa extends Auditoria
{
    protected $table = 'Programas';
    protected $primaryKey = 'Id';
    protected $fillable = [
        'Nombre', 'Descripcion', 'IntensidadHoraria', 'Modalidad',
        'Imagen', 'IdCategoriaPrograma', 'Estado',
    ];
    protected $casts = ['Estado' => 'boolean', 'IntensidadHoraria' => 'integer'];

    public function categoriaPrograma(): BelongsTo
    {
        return $this->belongsTo(CategoriaPrograma::class, 'IdCategoriaPrograma', 'Id');
    }
}