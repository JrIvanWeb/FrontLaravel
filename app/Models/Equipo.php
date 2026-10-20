<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Auditoria
{
    protected $table = 'Equipo';
    protected $primaryKey = 'Id';
    protected $fillable = ['Imagen', 'Nombres', 'Apellidos', 'Cargo', 'Whatsapp', 'Estado'];
    protected $casts = ['Estado' => 'boolean'];
}