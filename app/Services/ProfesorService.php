<?php

namespace App\Services;

use App\Models\Profesor;
use App\Interfaces\IProfesorService;
use App\Repositories\Interfaces\IProfesorRepository;
use App\DTOs\Profesor\StoreProfesorDTO;
use App\DTOs\Profesor\UpdateProfesorDTO;

class ProfesorService implements IProfesorService{

    protected IProfesorRepository $repository;

    public function __construct(IProfesorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(){
        return $this->repository->getAll();
    }

    public function create(StoreProfesorDTO $dto){

        return $this->repository->create($dto);

    }

    public function getById($id){

        return $this->repository->find($id);
    }

    public function update($id, UpdateProfesorDTO $dto){

        return $this->repository->update($id, $dto);

    }

    public function delete ($id){
        return $this->repository->delete($id);
    }
}