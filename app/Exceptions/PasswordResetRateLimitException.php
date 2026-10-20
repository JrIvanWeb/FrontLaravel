<?php

namespace App\Exceptions;

class PasswordResetRateLimitException extends ApiException
{
    public function __construct()
    {
        parent::__construct(
            'Se alcanzó el límite de intentos. Espera antes de volver a intentarlo.',
            429,
            'PASSWORD_RESET_RATE_LIMITED'
        );
    }
}