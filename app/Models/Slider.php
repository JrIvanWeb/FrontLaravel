<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Auditoria
{
    protected $table = 'Slider';
    protected $primaryKey = 'Id';
    protected $fillable = ['Imagen', 'Nombre', 'Url', 'Estado'];
    protected $casts = ['Estado' => 'boolean'];
}