<?php

namespace App\Interfaces;

interface IEstudianteService {
    
    public function getAll ();

    public function create(array $data);

    public function getById($id);

    public function update($id, array $data);

    public function delete ($id);
}