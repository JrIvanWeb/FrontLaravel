<?php

namespace App\Http\Controllers;

use App\Interfaces\IGaleriaService;

class GaleriaController extends ApiResourceController
{
    public function __construct(IGaleriaService $service)
    {
        parent::__construct($service);
    }

    protected array $rules = [
        'Imagen' => ['required', 'file', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        'IdTipoGaleria' => ['required', 'integer', 'exists:TipoGaleria,Id'],
        'Estado' => ['required', 'boolean'],
    ];
}