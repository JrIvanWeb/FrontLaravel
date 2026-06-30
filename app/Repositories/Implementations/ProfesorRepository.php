<?php

namespace App\Repositories\Implementations;

use App\Models\Profesor;
use App\Repositories\Interfaces\IProfesorRepository;

class ProfesorRepository implements IProfesorRepository 
{
    public function getAll(){
        return Profesor::all();
    }

    public function create(array $data): Profesor{

        return Profesor::create($data);
    }

    public function getById($id): Profesor{

        return Profesor::find($id);
    }

    public function update($id, array $data): Profesor{

        $profesor = Profesor::find($id);
        if(!$profesor){
            return null;
        }

        $profesor -> update ($data);
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
