<?php

namespace App\Http\Controllers;

use App\Interfaces\INosotrosService;
use App\Models\Nosotros;
use Illuminate\Database\Eloquent\Collection;

class NosotrosController extends ApiResourceController
{
    public function __construct(INosotrosService $service)
    {
        parent::__construct($service);
    }

    public function index(): Collection
    {
        return Nosotros::query()->orderByDesc('FechaActualizacion')->orderByDesc('Id')->limit(1)->get();
    }

    public function adminIndex(): Collection
    {
        return Nosotros::query()->orderByDesc('FechaActualizacion')->orderByDesc('Id')->get();
    }

    protected array $rules = [
        'QuienesSomos' => ['required', 'string'],
        'Mision' => ['required', 'string'],
        'Vision' => ['required', 'string'],
        'Imagen' => ['required', 'file', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        'NumeroGraduados' => ['required', 'integer', 'min:0'],
        'NumeroActivos' => ['required', 'integer', 'min:0'],
        'AniosTrayectoria' => ['required', 'integer', 'min:0'],
        'NumeroEmpresas' => ['required', 'integer', 'min:0'],
    ];
}
