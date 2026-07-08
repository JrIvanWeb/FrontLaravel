<?php

namespace App\Services;

use App\Models\Curso;
use App\Interfaces\ICursoService;
use App\Repositories\Interfaces\ICursoRepository;
use App\DTOs\Curso\StoreCursoDTO;
use App\DTOs\Curso\UpdateCursoDTO;

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
    
   public function create (StoreCursoDTO $dto)
   {
    return $this->repository->create($dto);
   }

   public function getById($id){

    return $this->repository->find($id);
   }

   public function update($id, UpdateCursoDTO $dto)
   {

    return $this->repository->update($id, $dto);
   }

    public function delete ($id){
       return $this->repository->delete($id);
    }
   
}
