<?php

namespace App\Repositories\Interfaces;

use App\Models\Estudiante;

interface IEstudianteRepository
{
    public function getAll();

    public function create(array $data): Estudiante;

    public function getById($id): ?Estudiante;

    public function update($id, array $data): ?Estudiante;

    public function delete($id): bool;
}