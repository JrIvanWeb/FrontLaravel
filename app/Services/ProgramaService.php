<?php

namespace App\Services;

use App\Interfaces\IProgramaService;
use App\Models\Programa;

class ProgramaService extends CrudService implements IProgramaService
{
    protected string $modelClass = Programa::class;
    protected array $fileFields = ['Imagen' => 'uploads/programas'];
}