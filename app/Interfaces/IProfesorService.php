<?php

namespace App\Interfaces;

interface IProfesorService {
    public function getall ();

    public function create(array $data);

    public function getById($id);

    public function update($id, array $data);

    public function delete ($id);
}