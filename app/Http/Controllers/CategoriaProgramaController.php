<?php

namespace App\Http\Controllers;

use App\Interfaces\ICategoriaProgramaService;
use App\Models\CategoriaPrograma;
use Illuminate\Database\Eloquent\Collection;

class CategoriaProgramaController extends ApiResourceController
{
    public function __construct(ICategoriaProgramaService $service)
    {
        parent::__construct($service);
    }

    public function index(): Collection
    {
        return CategoriaPrograma::query()
            ->where('Estado', true)
            ->orderBy('Id')
            ->get();
    }

    public function adminIndex(): Collection
    {
        return CategoriaPrograma::query()->orderBy('Id')->get();
    }

    protected array $rules = [
        'Nombre' => ['required', 'string', 'max:255'],
        'Estado' => ['required', 'boolean'],
    ];
}
