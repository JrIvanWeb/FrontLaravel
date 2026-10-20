<?php

namespace App\Http\Controllers;

use App\Interfaces\ITipoGaleriaService;

class TipoGaleriaController extends ApiResourceController
{
    public function __construct(ITipoGaleriaService $service)
    {
        parent::__construct($service);
    }

    protected array $rules = [
        'Nombre' => ['required', 'string', 'max:255'],
        'Estado' => ['required', 'boolean'],
    ];
}