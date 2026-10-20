<?php

namespace App\Exceptions;

class InvalidPasswordResetCodeException extends ApiException
{
    public function __construct()
    {
        parent::__construct(
            'El código de recuperación no es válido o ya expiró.',
            422,
            'INVALID_PASSWORD_RESET_CODE'
        );
    }
}