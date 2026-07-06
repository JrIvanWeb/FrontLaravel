<?php

namespace App\DTOs\Estudiante;

class StoreEstudianteDTO{
    public function __construct(
        public readonly string $nombres,
        public readonly string $apellidos,
        public readonly int $curso_id
    ){
    }
}