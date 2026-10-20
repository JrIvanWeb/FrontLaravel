<?php

namespace App\Exceptions;

class ResourceNotFoundException extends ApiException
{
    public function __construct(string $resource = 'registro')
    {
        parent::__construct(
            "No se encontró el recurso {$resource} solicitado.",
            404,
            'NOT_FOUND'
        );
    }
}