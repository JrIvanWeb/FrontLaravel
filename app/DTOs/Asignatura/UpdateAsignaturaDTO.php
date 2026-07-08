<?php

namespace App\DTOs\Asignatura;

class UpdateAsignaturaDTO{
    public function __construct(
        public readonly string $nombre
    ){
    }
}