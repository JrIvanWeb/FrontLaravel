<?php

namespace App\Services;

use App\Interfaces\ICategoriaProgramaService;
use App\Models\CategoriaPrograma;

class CategoriaProgramaService extends CrudService implements ICategoriaProgramaService
{
    protected string $modelClass = CategoriaPrograma::class;
}