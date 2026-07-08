<?php

namespace App\Repositories\Interfaces;
use App\DTOs\Profesor\StoreProfesorDTO;
use App\DTOs\Profesor\UpdateProfesorDTO;

use App\Models\Profesor;

interface IProfesorRepository
{
    public function getAll();

    public function create(StoreProfesorDTO $dto): Profesor;

    public function getById($id): ?Profesor;

    public function update($id, UpdateProfesorDTO $dto): ?Profesor;

    public function delete($id): bool;
}