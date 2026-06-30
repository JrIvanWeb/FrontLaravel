<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Estudiante;
use App\Models\Asignatura;

class Curso extends Model
{
    protected $table = 'curso';
    protected $fillable = ['nombre'];

    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class);
    }

    public function asignaturas()
    {
    return $this->belongsToMany(
        Asignatura::class,
        'curso_asignaturas'
    );
   }
}

