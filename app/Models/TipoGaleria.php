<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoGaleria extends Auditoria
{
    protected $table = 'TipoGaleria';
    protected $primaryKey = 'Id';
    protected $fillable = ['Nombre', 'Estado'];
    protected $casts = ['Estado' => 'boolean'];

    public function galerias(): HasMany
    {
        return $this->hasMany(Galeria::class, 'IdTipoGaleria', 'Id');
    }
}