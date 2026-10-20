<?php

namespace App\Exceptions;

use Throwable;

class DataConflictException extends ApiException
{
    public function __construct(array $errors = [], ?Throwable $previous = null)
    {
        parent::__construct(
            'El registro entra en conflicto con datos existentes o relaciones.',
            409,
            'DATA_CONFLICT',
            $errors,
            $previous
        );
    }
}