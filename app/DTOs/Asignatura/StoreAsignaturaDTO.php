<?php

namespace App\DTOs\Asignatura;

class StoreAsignaturaDTO{
    public function __construct(
        public readonly string $nombre
    ){
    }
}