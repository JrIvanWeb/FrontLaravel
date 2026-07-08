<?php

namespace App\Interfaces;
use App\DTOs\Asignatura\StoreAsignaturaDTO;

interface IAsignaturaService {
    public function getAll();

    public function create(StoreAsignaturaDTO $dto);

    public function getById($id);

    public function update($id, UpdateAsignatura $dto);

    public function delete($id);
}