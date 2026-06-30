<?php

namespace App\Repositories\Implementations;

use App\Models\Estudiante;
use App\Repositories\Interfaces\IEstudianteRepository;

class EstudianteRepository implements IEstudianteRepository {
    

    public function getAll()
    {
        return Estudiante::with('curso')->get();
    }

    public function create(array $data): Estudiante
    {

        return Estudiante::create($data);

    }

    public function getById($id): Estudiante
    {
        return Estudiante::find($id);
    }

        public function update($id, array $data): ?Estudiante
    {
        $estudiante = Estudiante::find($id);

        if (!$estudiante) {
            return null;
        }

        $estudiante->update($data);

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