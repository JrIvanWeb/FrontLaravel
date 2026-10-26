<?php

namespace App\Http\Controllers;

use App\Interfaces\IProgramaService;
use App\Models\Programa;
use Illuminate\Database\Eloquent\Collection;

class ProgramaController extends ApiResourceController
{
    public function __construct(IProgramaService $service)
    {
        parent::__construct($service);
    }

    public function index(): Collection
    {
        return Programa::query()
            ->where('Estado', true)
            ->with('categoriaPrograma:Id,Nombre')
            ->orderBy('Id')
            ->get();
    }

    public function adminIndex(): Collection
    {
        return Programa::query()
            ->with('categoriaPrograma:Id,Nombre')
            ->orderBy('Id')
            ->get();
    }

    protected array $rules = [
        'Nombre' => ['required', 'string', 'max:255'],
        'Descripcion' => ['required', 'string'],
        'IntensidadHoraria' => ['required', 'integer', 'min:0'],
        'Modalidad' => ['required', 'string', 'max:255'],
        'Imagen' => ['required', 'file', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        'IdCategoriaPrograma' => ['required', 'integer', 'exists:CategoriaPrograma,Id'],
        'Estado' => ['required', 'boolean'],
    ];
}
