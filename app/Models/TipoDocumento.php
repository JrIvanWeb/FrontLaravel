<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoDocumento extends Auditoria
{
    protected $table = 'TipoDocumento';
    protected $primaryKey = 'Id';
    protected $fillable = ['Nombre'];

    public function usuarios(): HasMany
    {
        return $this->hasMany(Usuario::class, 'IdTipoDocumento', 'Id');
    }
}