<?php

namespace App\Http\Controllers;

use App\Interfaces\IUsuarioService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class UsuarioController extends ApiResourceController
{
    public function __construct(IUsuarioService $service)
    {
        parent::__construct($service);
    }

    protected array $rules = [
        'Nombres' => ['required', 'string', 'max:255'],
        'Apellidos' => ['required', 'string', 'max:255'],
        'Correo' => ['required', 'email', 'max:255', 'unique:Usuarios,Correo'],
        'Telefono' => ['required', 'string', 'max:50'],
        'IdTipoDocumento' => ['required', 'integer', 'exists:TipoDocumento,Id'],
        'Documento' => ['required', 'string', 'max:100'],
        'Estado' => ['required', 'boolean'],
        'IdRol' => ['required', 'integer', 'exists:Rol,Id'],
        'Password' => ['required', 'string', 'min:8'],
    ];

    protected function updateRules(Model $record): array
    {
        return [
            'Nombres' => ['sometimes', 'required', 'string', 'max:255'],
            'Apellidos' => ['sometimes', 'required', 'string', 'max:255'],
            'Correo' => [
                'sometimes', 'required', 'email', 'max:255',
                Rule::unique('Usuarios', 'Correo')->ignore($record->getKey(), 'Id'),
            ],
            'Telefono' => ['sometimes', 'required', 'string', 'max:50'],
            'IdTipoDocumento' => ['sometimes', 'required', 'integer', 'exists:TipoDocumento,Id'],
            'Documento' => ['sometimes', 'required', 'string', 'max:100'],
            'Estado' => ['sometimes', 'required', 'boolean'],
            'IdRol' => ['sometimes', 'required', 'integer', 'exists:Rol,Id'],
            'Password' => ['sometimes', 'required', 'string', 'min:8'],
        ];
    }
}