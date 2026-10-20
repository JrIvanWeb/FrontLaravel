<?php

namespace App\Exceptions;

class InvalidCredentialsException extends ApiException
{
    public function __construct()
    {
        parent::__construct(
            'Correo o contraseña inválidos.',
            401,
            'INVALID_CREDENTIALS'
        );
    }
}