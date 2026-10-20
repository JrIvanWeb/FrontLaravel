<?php

namespace App\Http\Controllers;

use App\Interfaces\ITipoDocumentoService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class TipoDocumentoController extends ApiResourceController
{
    public function __construct(ITipoDocumentoService $service)
    {
        parent::__construct($service);
    }

    protected array $rules = [
        'Nombre' => ['required', 'string', 'max:255', 'unique:TipoDocumento,Nombre'],
    ];

    protected function updateRules(Model $record): array
    {
        return [
            'Nombre' => [
                'sometimes', 'required', 'string', 'max:255',
                Rule::unique('TipoDocumento', 'Nombre')->ignore($record->getKey(), 'Id'),
            ],
        ];
    }
}