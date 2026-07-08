<?php

namespace App\DTOs\Profesor;

class StoreProfesorDTO{
    public function __construct(
        public readonly string $nombres,
        public readonly string $apellidos
    ){
    }
}