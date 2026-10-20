<?php

namespace App\Http\Controllers;

use App\Interfaces\ISliderService;

class SliderController extends ApiResourceController
{
    public function __construct(ISliderService $service)
    {
        parent::__construct($service);
    }

    protected array $rules = [
        'Imagen' => ['required', 'file', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        'Nombre' => ['required', 'string', 'max:255'],
        'Url' => ['required', 'string', 'max:2048'],
        'Estado' => ['required', 'boolean'],
    ];
}