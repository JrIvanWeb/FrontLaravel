<?php

namespace App\Services;

use App\Interfaces\IAliadoService;
use App\Models\Aliado;

class AliadoService extends CrudService implements IAliadoService
{
    protected string $modelClass = Aliado::class;
    protected array $fileFields = ['Imagen' => 'uploads/aliados'];
}