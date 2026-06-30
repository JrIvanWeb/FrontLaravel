<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Curso;

class Estudiante extends Model
{
    protected $fillable = [
        'nombres',
        'apellidos',
        'curso_id'
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }
}
