<?php

namespace App\Repositories\Interfaces;
use App\DTOs\Asignatura\StoreAsignaturaDTO;
use App\DTOs\Asignatura\UpdateAsignaturaDTO;

use App\Models\Asignatura;

interface IAsignaturaRepository
{
    public function getAll();

    public function create(StoreAsignaturaDTO $dto): Asignatura;

    public function getById($id): ?Asignatura;

    public function update ($id, UpdateAsignaturaDTO $dto): ?Asignatura;

    public function delete($id): bool;

}