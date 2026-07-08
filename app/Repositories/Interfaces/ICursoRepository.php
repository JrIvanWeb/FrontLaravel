<?php

namespace App\Repositories\Interfaces;

use App\Models\Curso;
use App\DTOs\Curso\StoreCursoDTO;
use App\DTOs\Curso\UpdateCursoDTO;

interface ICursoRepository
{ 
    public function getAll();

    public function create(StoreCursoDTO $dto): Curso;

    public function getById($id): ?Curso;

    public function update($id, UpdateCursoDTO $dto): ?Curso;

    public function delete($id): bool;
}