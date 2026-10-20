<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rol extends Auditoria
{
    protected $table = 'Rol';
    protected $primaryKey = 'Id';
    protected $fillable = ['Nombre'];

    public function usuarios(): HasMany
    {
        return $this->hasMany(Usuario::class, 'IdRol', 'Id');
    }
}