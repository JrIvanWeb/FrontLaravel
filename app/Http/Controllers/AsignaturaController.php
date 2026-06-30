<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asignatura;
use App\Services\AsignaturaService;
use App\Http\Requests\Asignatura\StoreRequest;
use App\Http\Requests\Asignatura\UpdateRequest;
use Illuminate\Http\JsonResponse;

class AsignaturaController extends Controller
{
    protected $asignaturaService;

    public function __construct(AsignaturaService $asignaturaService){
             $this->asignaturaService =$asignaturaService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->asignaturaService->getAll();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $asignatura = $this->asignaturaService->create($request->validated());

        return response()->json($asignatura, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $asignatura = $this->asignaturaService->getById($id);

        if(!$asignatura){
            return response()->json(['message' => 'Asignatura no encontrada'], 404);
        }
        return $asignatura;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $asignatura= $this->asignaturaService->update($id, $request->validated());

        if(!$asignatura){
            return response()->json(['message' => 'No encontrada'], 404);
        }

        return response()->json($asignatura);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $asignatura =$this->asignaturaService->delete($id);
        
        if(!$asignatura){
            return response()->json(['message' => 'No encontrada'], 404);
        }

        return response()->json(['message' => 'Asignatura eliminada correctamente'], 200);
    }
}
