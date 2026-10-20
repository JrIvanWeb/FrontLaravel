<?php

namespace App\Http\Controllers;

use App\Interfaces\IRolService;

class RolController extends ApiResourceController
{
    public function __construct(IRolService $service)
    {
        parent::__construct($service);
    }

    protected array $rules = [
        'Nombre' => ['required', 'string', 'max:255'],
    ];
}