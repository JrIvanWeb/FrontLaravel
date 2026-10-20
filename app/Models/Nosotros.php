<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nosotros extends Auditoria
{
    protected $table = 'Nosotros';
    protected $primaryKey = 'Id';
    protected $fillable = [
        'QuienesSomos', 'Mision', 'Vision', 'Imagen', 'NumeroGraduados',
        'NumeroActivos', 'AniosTrayectoria', 'NumeroEmpresas',
    ];
    protected $casts = [
        'NumeroGraduados' => 'integer',
        'NumeroActivos' => 'integer',
        'AniosTrayectoria' => 'integer',
        'NumeroEmpresas' => 'integer',
    ];
}