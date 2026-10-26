<?php

namespace App\Http\Controllers;

use App\Interfaces\IEquipoService;
use App\Models\Equipo;
use Illuminate\Database\Eloquent\Collection;

class EquipoController extends ApiResourceController
{
    public function __construct(IEquipoService $service)
    {
        parent::__construct($service);
    }

    public function index(): Collection
    {
        return Equipo::query()->where('Estado', true)->orderBy('Id')->get();
    }

    public function adminIndex(): Collection
    {
        return Equipo::query()->orderBy('Id')->get();
    }

    protected array $rules = [
        'Imagen' => ['required', 'file', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        'Nombres' => ['required', 'string', 'max:255'],
        'Apellidos' => ['required', 'string', 'max:255'],
        'Cargo' => ['required', 'string', 'max:255'],
        'Whatsapp' => ['required', 'string', 'max:50'],
        'Estado' => ['required', 'boolean'],
    ];
}
