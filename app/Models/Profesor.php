<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Asignatura;

class Profesor extends Model
{
    protected $table = 'profesores';

    protected $fillable = [
        'nombres',
        'apellidos'
    ];

    public function asignaturas()
    {
        return $this->belongsToMany(
            Asignatura::class,
            'profesor_asignaturas'
        );
    }
}