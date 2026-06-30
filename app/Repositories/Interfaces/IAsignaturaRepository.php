<?php

namespace App\Repositories\Interfaces;

use App\Models\Asignatura;

interface IAsignaturaRepository
{
    public function getAll();

    public function create(array $data): Asignatura;

    public function getById($id): ?Asignatura;

    public function update ($id, array $data): ?Asignatura;

    public function delete($id): bool;

}