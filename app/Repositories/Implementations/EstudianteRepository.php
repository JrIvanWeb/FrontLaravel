<?php

namespace App\Repositories\Implementations;

use App\Models\Estudiante;
use App\Repositories\Interfaces\IEstudianteRepository;
use App\DTOs\Estudiante\StoreEstudianteDTO;
use App\DTOs\Estudiante\UpdateEstudianteDTO;

class EstudianteRepository implements IEstudianteRepository {
    

    public function getAll()
    {
        return Estudiante::with('curso')->get();
    }

    public function create(StoreEstudianteDTO $dto): Estudiante
    {

         return Estudiante::create([
        'nombres' => $dto->nombres,
        'apellidos' => $dto->apellidos,
        'curso_id' => $dto->curso_id,
        ]);

    }

    public function getById($id): Estudiante
    {
        return Estudiante::find($id);
    }

    public function update($id, UpdateEstudianteDTO $dto): ?Estudiante
    {
        $estudiante = Estudiante::find($id);

        if (!$estudiante) {
            return null;
        }

        $estudiante->update([
             'nombres'   => $dto->nombres,
             'apellidos' => $dto->apellidos,
             'curso_id'  => $dto->curso_id,
              ]);

              
        return $estudiante;
    }

    public function delete($id): bool
    {
        $estudiante = Estudiante::find($id);

        if (!$estudiante) {
            return false;
        }

        return $estudiante->delete();
    }

}