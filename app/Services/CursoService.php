<?php

namespace App\Services;

use App\Models\Curso;
use App\Interfaces\ICursoService;
use App\Repositories\Interfaces\ICursoRepository;

class CursoService implements IcursoService
{
    protected ICursoRepository $repository;

    public function __construct(ICursoRepository $repository)
    {
        $this->repository = $repository;
    }

   public function getAll(){

    return $this->repository->getAll();

   }
    
   public function create (array $data)
   {
    return $this->repository->create($data);
   }

   public function getById($id){

    return $this->repository->find($id);
   }

   public function update($id, array $data)
   {

    return $this->repository->update($id, $data);
   }

    public function delete ($id){
       return $this->repository->delete($id);
    }
   
}
