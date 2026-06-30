<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Curso;
use App\Models\Profesor;

class Asignatura extends Model
{
    protected $fillable = ['nombre'];

    public function cursos()
    {
        return $this->belongsToMany(
            Curso::class,
            'curso_asignaturas'
        );
    }

    
    public function profesores()
    {
    return $this->belongsToMany(
        Profesor::class,
        'profesor_asignaturas'
    );
    }
}
