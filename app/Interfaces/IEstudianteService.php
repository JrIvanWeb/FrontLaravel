<?php

namespace App\Interfaces;

use App\DTOs\Estudiante\StoreEstudianteDTO;
use App\DTOs\Estudiante\UpdateEstudianteDTO;

interface IEstudianteService {
    
    public function getAll ();

    public function create(StoreEstudianteDTo $dto);

    public function getById($id);

    public function update($id, UpdateEstudianteDTO $dto);

    public function delete ($id);
}