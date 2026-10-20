<?php

namespace App\Services;

use App\Interfaces\IUsuarioService;
use App\Models\Usuario;

class UsuarioService extends CrudService implements IUsuarioService
{
    protected string $modelClass = Usuario::class;
}