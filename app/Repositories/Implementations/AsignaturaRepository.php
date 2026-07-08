<?php

namespace App\Repositories\Implementations;

use App\Models\Asignatura;
use App\Repositories\Interfaces\IAsignaturaRepository;
use App\DTOs\Asignatura\StoreAsignaturaDTO;
use App\DTOs\Asignatura\UpdateAsignaturaDTO;

class AsignaturaRepository implements IAsignaturaRepository
{
    public function getAll(){
        return Asignatura::all();
    }

    public function create(StoreAsignaturaDTO $dto): Asignatura
    {
        return asignatura::create([
            'nombre' => $dto->nombre
        ]);
    }

    public function getById($id): Asignatura
    {
         return Asignatura::find($id);
    }

    public function update ($id, UpdateAsignaturaDTO $dto): Asignatura
    {

       $asignatura = Asignatura::find($id);

       if(!$asignatura){
        return null;
       }

       $asignatura->update([
        'nombre' => $dto->nombre
       ]);
       return $asignatura;
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
