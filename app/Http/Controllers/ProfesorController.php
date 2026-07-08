<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profesor;
use App\Services\ProfesorService;
use App\Http\Requests\Profesor\StoreRequest;
use App\Http\Requests\Profesor\UpdateRequest;
use Illuminate\Http\JsonResponse;
use App\DTOs\Profesor\StoreProfesorDTO;
use App\DTOs\Profesor\UpdateProfesorDTO;

class ProfesorController extends Controller
{
    protected $profesorService;

    public function __construct(ProfesorService $profesorService)
    {
               $this->profesorService =$profesorService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->profesorService->getAll();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {

        $profesor = $this->profesorService->create($request->toDTO());

        return response()->json($profesor, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $profesor = $this->profesorService->getById($id);

        if(!$profesor){
            return response()->json(['message' => 'Profesor no encontrado'], 404);
        }

        return $profesor;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $profesor = $this->profesorService->update($id, $request->toDTO());

        if(!$profesor){
            return response()->json(['message' => 'Profesor no encontrado'], 404);
        }

        return response()->json($profesor);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $profesor = $this->profesorService->delete($id);
        
        if(!$profesor){
            return response()->json(['message' => 'Profesor no encontrado'], 404);
        }

        return response()->json(['message' => 'Profesor eliminado Correctamente'], 200);
    }
}
