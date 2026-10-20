<?php

namespace App\Exceptions;

class InsufficientRoleException extends ApiException
{
    public function __construct()
    {
        parent::__construct(
            'No tienes permiso para realizar esta acción.',
            403,
            'FORBIDDEN'
        );
    }
}