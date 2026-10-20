<?php

namespace App\Services;

use App\Interfaces\INosotrosService;
use App\Models\Nosotros;

class NosotrosService extends CrudService implements INosotrosService
{
    protected string $modelClass = Nosotros::class;
    protected array $fileFields = ['Imagen' => 'uploads/nosotros'];
}