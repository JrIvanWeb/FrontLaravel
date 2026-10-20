<?php

namespace App\Services;

use App\Interfaces\IGaleriaService;
use App\Models\Galeria;

class GaleriaService extends CrudService implements IGaleriaService
{
    protected string $modelClass = Galeria::class;
    protected array $fileFields = ['Imagen' => 'uploads/galeria'];
}