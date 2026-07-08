<?php

namespace App\Repositories\Implementations;

use App\Models\Profesor;
use App\Repositories\Interfaces\IProfesorRepository;
use App\DTOs\Profesor\StoreProfesorDTO;
use App\DTOs\Profesor\UpdateProfesorDTO;

class ProfesorRepository implements IProfesorRepository 
{
    public function getAll(){
        return Profesor::all();
    }

    public function create(StoreProfesorDTO $dto): Profesor{

        return Profesor::create([
             'nombres' => $dto->nombres,
             'apellidos' => $dto->apellidos
        ]);
    }

    public function getById($id): Profesor{

        return Profesor::find($id);
    }

    public function update($id, UpdateProfesorDTO $dto): Profesor{

        $profesor = Profesor::find($id);
        if(!$profesor){
            return null;
        }

        $profesor -> update ([
            'nombres' => $dto->nombres,
            'apellidos' => $dto->apellidos
        ]);
        return $profesor;
    }

    public function delete ($id): bool{
        $profesor = Profesor::find($id);
        if(!$profesor){
            return null;
        }
        $profesor->delete();
        return true;
    }

}
