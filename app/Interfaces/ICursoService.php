<?php

namespace App\Interfaces;
use App\DTOs\Curso\StoreCursoDTO;
use App\DTOs\Curso\UpdateCursoDTO;

interface ICursoService {
    public function getAll();

    public function create (StoreCursoDTO $dto);

    public function getById($id);

    public function update($id, array $data);

    public function delete ($id);
}