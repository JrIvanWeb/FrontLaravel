<?php

namespace App\Repositories\Interfaces;

use App\Models\Profesor;

interface IProfesorRepository
{
    public function getAll();

    public function create(array $data): Profesor;

    public function getById($id): ?Profesor;

    public function update($id, array $data): ?Profesor;

    public function delete($id): bool;
}