<?php

namespace App\DTOs\Curso;

class StoreCursoDTO {
    public function __construct (
        public readonly string $nombre
    ){
    }
}