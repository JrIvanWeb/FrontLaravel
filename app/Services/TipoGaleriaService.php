<?php

namespace App\Services;

use App\Interfaces\ITipoGaleriaService;
use App\Models\TipoGaleria;

class TipoGaleriaService extends CrudService implements ITipoGaleriaService
{
    protected string $modelClass = TipoGaleria::class;
}