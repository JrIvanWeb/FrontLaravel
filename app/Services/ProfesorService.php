<?php

namespace App\Services;

use App\Models\Profesor;
use App\Interfaces\IProfesorService;
use App\Repositories\Interfaces\IProfesorRepository;

class ProfesorService implements IProfesorService{

    protected IProfesorRepository $repository;

    public function __construct(IProfesorRepository $repository)
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

    public function update($id, array $data){

        return $this->repository->update($id, $data);

    }

    public function delete ($id){
        return $this->repository->delete($id);
    }
}