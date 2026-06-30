<?php

namespace App\Repositories\implementations;

use App\Models\Curso;
use App\Repositories\Interfaces\ICursoRepository;


class CursoRepository implements ICursoRepository 
{
   public function getAll()
    {
    return Curso::all();
    }

   public function create (array $data): Curso
   {
    return Curso::create($data);
   }

   public function getById($id): Curso
   {
    return Curso::find($id);
   }

   public function update($id, array $data): Curso
   {

    $curso =  Curso::find($id);

    if (!$curso) {
        return null;
    }

    $curso->update ($data);
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