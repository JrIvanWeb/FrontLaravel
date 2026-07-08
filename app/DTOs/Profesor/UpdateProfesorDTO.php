<?php

namespace App\DTOs\Profesor;

class UpdateProfesorDTO{
    public function __construct(
        public readonly string $nombres,
        public readonly string $apellidos
    ){
    }
}