<?php

namespace App\Interfaces;
use App\DTOs\Profesor\StoreProfesorDTO;
use App\DTOs\Profesor\UpdateProfesorDTO;

interface IProfesorService {
    public function getall ();

    public function create(StoreProfesorDTO $dto);

    public function getById($id);

    public function update($id, UpdateProfesorDTO $dto);

    public function delete ($id);
}