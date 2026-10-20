<?php

namespace App\Http\Controllers;

use App\Interfaces\IInfoService;

class InfoController extends ApiResourceController
{
    public function __construct(IInfoService $service)
    {
        parent::__construct($service);
    }

    protected array $rules = [
        'Direccion' => ['required', 'string', 'max:255'],
        'CiudadDepartamento' => ['required', 'string', 'max:255'],
        'Telefono' => ['required', 'string', 'max:50'],
        'Whatsapp' => ['required', 'string', 'max:50'],
        'Correo' => ['required', 'email', 'max:255'],
        'Facebook' => ['required', 'string', 'max:255'],
        'Instagram' => ['required', 'string', 'max:255'],
        'Logo' => ['required', 'file', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        'Youtube' => ['required', 'string', 'max:255'],
    ];
}