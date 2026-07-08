<?php

namespace App\Repositories\implementations;

use App\Models\Curso;
use App\Repositories\Interfaces\ICursoRepository;
use App\DTOs\Curso\StoreCursoDTO;
use App\DTOs\Curso\UpdateCursoDTO;


class CursoRepository implements ICursoRepository 
{
   public function getAll()
    {
    return Curso::all();
    }

   public function create (StoreCursoDTO $dto): Curso
   {
    return Curso::create([
        'nombre' => $dto->nombre
        ]);
   }

   public function getById($id): Curso
   {
    return Curso::find($id);
   }

   public function update($id, UpdateCursoDTO $dto): Curso
   {

    $curso =  Curso::find($id);

    if (!$curso) {
        return null;
    }

    $curso->update ([
           'nombre' => $dto->nombre
    ]);
    return $curso;
   }

    public function delete ($id): bool
    {
        $curso = Curso::find($id);

        if (!$curso) {
        return null;
        }
        $curso -> delete();
        return true;
    }

}