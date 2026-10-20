<?php

namespace App\Services;

use App\Interfaces\IRolService;
use App\Models\Rol;

class RolService extends CrudService implements IRolService
{
    protected string $modelClass = Rol::class;
}