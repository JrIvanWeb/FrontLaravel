<?php

namespace App\Services;

use App\Models\Asignatura;
use App\Interfaces\IAsignaturaService;
use App\Repositories\Interfaces\IAsignaturaRepository;
use App\DTOs\Asignatura\StoreAsignaturaDTO;
use App\DTOs\Asignatura\UpdateAsignaturaDTO;

 class AsignaturaService
{
    protected IAsignaturaRepository $repository;

    public function __construct(IAsignaturaRepository $repository)
    {
        $this->repository = $repository;
    }
    
    public function getAll(){
        return $this->repository->getAll();
    }

    public function create(StoreAsignaturaDTO $dto){
        return $this->repository->create($dto);
    }
    
    public function getById($id){
         return $this->repository->find($id);
    }

    public function update ($id, UpdateAsignaturaDTO $dto){

       return $this->repository->update($id, $dto);
    }

    public function delete($id){
        return $this->repository->delete($id);
    }
}
