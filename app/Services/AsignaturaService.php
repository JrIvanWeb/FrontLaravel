<?php

namespace App\Services;

use App\Models\Asignatura;
use App\Interfaces\IAsignaturaService;
use App\Repositories\Interfaces\IAsignaturaRepository;

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

    public function create(array $data){
        return $this->repository->create($data);
    }
    
    public function getById($id){
         return $this->repository->find($id);
    }

    public function update ($id, array $data){

       return $this->repository->find($id);
    }

    public function delete($id){
        return $this->repository->find($id);
    }
}
