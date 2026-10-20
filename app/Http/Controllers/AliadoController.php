<?php

namespace App\Http\Controllers;

use App\Interfaces\IAliadoService;

class AliadoController extends ApiResourceController
{
    public function __construct(IAliadoService $service)
    {
        parent::__construct($service);
    }

    protected array $rules = [
        'Nombre' => ['required', 'string', 'max:255'],
        'Imagen' => ['required', 'file', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        'Estado' => ['required', 'boolean'],
    ];
}