<?php

namespace App\Repositories\Interfaces;

use App\Models\Estudiante;
use App\DTOs\Estudiante\StoreEstudianteDTO;
use App\DTOs\Estudiante\UpdateEstudianteDTO;

interface IEstudianteRepository
{
    public function getAll();

    public function create(StoreEstudianteDTO $dto): Estudiante;

    public function getById($id): ?Estudiante;

    public function update($id, UpdateEstudianteDTO $dto): ?Estudiante;

    public function delete($id): bool;
}