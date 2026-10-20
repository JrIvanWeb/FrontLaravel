<?php

namespace App\Interfaces;

interface IPasswordResetService
{
    public function sendCode(string $email): void;

    public function resetPassword(string $email, string $code, string $password): void;
}