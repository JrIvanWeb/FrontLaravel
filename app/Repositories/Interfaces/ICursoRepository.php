<?php

namespace App\Repositories\Interfaces;

use App\Models\Curso;
use App\DTOs\Curso\StoreCursoDTO;

interface ICursoRepository
{ 
    public function getAll();

    public function create(StoreCursoDTO $dto): Curso;

    public function getById($id): ?Curso;

    public function update($id, array $data): ?Curso;

    public function delete($id): bool;
}