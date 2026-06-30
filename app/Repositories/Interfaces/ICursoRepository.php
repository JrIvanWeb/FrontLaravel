<?php

namespace App\Repositories\Interfaces;

use App\Models\Curso;

interface ICursoRepository
{ 
    public function getAll();

    public function create(array $data): Curso;

    public function getById($id): ?Curso;

    public function update($id, array $data): ?Curso;

    public function delete($id): bool;
}