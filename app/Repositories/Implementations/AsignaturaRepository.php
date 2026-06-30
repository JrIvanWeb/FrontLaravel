<?php

namespace App\Repositories\Implementations;

use App\Models\Asignatura;
use App\Repositories\Interfaces\IAsignaturaRepository;

class AsignaturaRepository implements IAsignaturaRepository
{
    public function getAll(){
        return Asignatura::all();
    }

    public function create(array $data): Asignatura
    {
        return asignatura::create($data);
    }

    public function getById($id): Asignatura
    {
         return Asignatura::find($id);
    }

    public function update ($id, array $data): Asignatura
    {

       $asignatura = Asignatura::find($id);

       if(!$asignatura){
        return null;
       }

       $asignatura->update($data);
       return $asiganatura;
    }

    public function delete($id): bool
    {
        $asignatura = Asignatura::find($id);

        if(!$asignatura){
            return null;
        }

        $asignatura->delete($id);
        return true;
    }

}
