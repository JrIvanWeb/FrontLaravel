<?php

namespace App\Http\Controllers;

use App\Interfaces\IAliadoService;
use App\Models\Aliado;
use Illuminate\Database\Eloquent\Collection;

class AliadoController extends ApiResourceController
{
    public function __construct(IAliadoService $service)
    {
        parent::__construct($service);
    }

    public function index(): Collection
    {
        return Aliado::query()->where('Estado', true)->orderBy('Id')->get();
    }

    public function adminIndex(): Collection
    {
        return Aliado::query()->orderBy('Id')->get();
    }

    protected array $rules = [
        'Nombre' => ['required', 'string', 'max:255'],
        'Imagen' => ['required', 'file', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        'Estado' => ['required', 'boolean'],
    ];
}
