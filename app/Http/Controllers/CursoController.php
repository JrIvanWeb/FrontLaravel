<?php

namespace App\Http\Controllers;

use App\Http\Requests\Curso\StoreRequest;
use App\Http\Requests\Curso\UpdateRequest;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Curso;
use App\Services\CursoService;
use App\DTOs\Curso\StoreCursoDTO;

class CursoController extends Controller
{
    protected $cursoService;

    public function __construct(CursoService $cursoService){
        $this->cursoService = $cursoService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return $this->cursoService->getAll();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): JsonResponse
    { 
    
        $curso = $this->cursoService->create(
            $request->toDTO()
        );

        return response()->json($curso, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $curso = $this->cursoService->getById($id);

        if(!$curso){
            return response()->json(['message' => 'Curso no encontrado'], 404);
        }

        return $curso;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id): JsonResponse
    {

        $curso =$this->cursoService->update($id, $request->validated());

        if(!$curso){
            return response()->json(['message' => 'Curso no encontrado'], 404);
        }

        return response()->json($curso);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $curso = $this->cursoService->delete($id);
        
        if(!$curso){
            return response()->json(['message' => 'Curso no encontrado'], 404);
        }

        return response()->json(['message' => 'Curso eliminado Correctamente'], 200);
    }

}
