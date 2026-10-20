<?php

namespace App\Services;

use App\Interfaces\IEquipoService;
use App\Models\Equipo;

class EquipoService extends CrudService implements IEquipoService
{
    protected string $modelClass = Equipo::class;
    protected array $fileFields = ['Imagen' => 'uploads/equipo'];
}