<?php

namespace App\Services;

use App\Models\Estudiante;
use App\Interfaces\IEstudianteService;
use App\Repositories\Interfaces\IEstudianteRepository;

class EstudianteService implements IEstudianteService
{
    protected IEstudianteRepository $repository;

    public function __construct(IEstudianteRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function create(array $data){

        return $this->repository->create($data);

    }

    public function getById($id){
        return $this->repository->find($id);
    }

   public function update($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}

