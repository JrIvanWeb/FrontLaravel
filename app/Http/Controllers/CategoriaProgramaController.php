<?php

namespace App\Http\Controllers;

use App\Interfaces\ICategoriaProgramaService;

class CategoriaProgramaController extends ApiResourceController
{
    public function __construct(ICategoriaProgramaService $service)
    {
        parent::__construct($service);
    }

    protected array $rules = [
        'Nombre' => ['required', 'string', 'max:255'],
        'Estado' => ['required', 'boolean'],
    ];
}