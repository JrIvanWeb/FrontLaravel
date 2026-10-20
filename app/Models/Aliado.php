<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aliado extends Auditoria
{
    protected $table = 'Aliados';
    protected $primaryKey = 'Id';
    protected $fillable = ['Nombre', 'Imagen', 'Estado'];
    protected $casts = ['Estado' => 'boolean'];
}