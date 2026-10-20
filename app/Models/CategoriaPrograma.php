<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoriaPrograma extends Auditoria
{
    protected $table = 'CategoriaPrograma';
    protected $primaryKey = 'Id';
    protected $fillable = ['Nombre', 'Estado'];
    protected $casts = ['Estado' => 'boolean'];

    public function programas(): HasMany
    {
        return $this->hasMany(Programa::class, 'IdCategoriaPrograma', 'Id');
    }
}