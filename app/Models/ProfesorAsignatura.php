<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfesorAsignatura extends Model
{
    protected $table = 'profesor_asignaturas';

    protected $fillable = [
        'profesor_id', 
        'asignatura_id' 
        ];
}