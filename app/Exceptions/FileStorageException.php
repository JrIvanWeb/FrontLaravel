<?php

namespace App\Exceptions;

class FileStorageException extends ApiException
{
    public function __construct(string $field)
    {
        parent::__construct(
            "No fue posible guardar el archivo del campo {$field}.",
            500,
            'FILE_STORAGE_ERROR',
            [$field => ['No se pudo guardar el archivo.']]
        );
    }
}