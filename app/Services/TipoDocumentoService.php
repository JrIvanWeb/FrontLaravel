<?php

namespace App\Services;

use App\Interfaces\ITipoDocumentoService;
use App\Models\TipoDocumento;

class TipoDocumentoService extends CrudService implements ITipoDocumentoService
{
    protected string $modelClass = TipoDocumento::class;
}