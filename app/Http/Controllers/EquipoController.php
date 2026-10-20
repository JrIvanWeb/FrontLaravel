<?php

namespace App\Http\Controllers;

use App\Interfaces\IEquipoService;

class EquipoController extends ApiResourceController
{
    public function __construct(IEquipoService $service)
    {
        parent::__construct($service);
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