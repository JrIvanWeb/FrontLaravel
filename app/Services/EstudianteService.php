<?php

namespace App\Services;

use App\Models\Estudiante;
use App\Interfaces\IEstudianteService;
use App\Repositories\Interfaces\IEstudianteRepository;
use App\DTOs\Estudiante\StoreEstudianteDTO;
use App\DTOs\Estudiante\UpdateEstudianteDTO;

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

    public function create(StoreEstudianteDTo $dto){

        return $this->repository->create($dto);

    }

    public function getById($id){
        return $this->repository->find($id);
    }

   public function update($id, UpdateEstudianteDTO $dto)
    {
        return $this->repository->update($id, $dto);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}

