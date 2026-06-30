<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Requests\Estudiante\StoreRequest;
use App\Requests\Estudiante\UpdateRequest;
use Illuminate\Http\JsonResponse;
use App\Models\Estudiante;
use App\Services\EstudianteService;

class EstudianteController extends Controller
{
    protected $estudianteService;

    public function __construct(EstudianteService $estudianteService)
    {
        $this->estudianteService = $estudianteService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      return $this->estudianteService->getAll();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $estudiante = $this->estudianteService->create(
            $request->validated()
        );

        return response()->json($estudiante, 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $estudiante =$this->estudianteService->getById($id);

        if(!$estudiante){
            return response()->json(['message' => 'Estudiante no encontrado'], 404);
        }
        
        return $estudiante;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {

        $estudiante=$this->estudianteService->update($id, $request->validated());
        
        if(!$estudiante){
            return response()->json(['message' => 'Estudiante no encontrado'], 404);
        }

        return response()->json($estudiante);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $estudiante = $this->estudianteService->delete($id);
        
        if(!$estudiante){
            return response()->json(['message' => 'Estudiante no encontrado'], 404);
        }
    
        return response()->json(['message' => 'Estudiante eliminado Correctamente'], 200);
    }
}
