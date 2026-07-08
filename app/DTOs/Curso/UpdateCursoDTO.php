<?php

namespace App\DTOs\Curso;

class  UpdateCursoDTO{
    public function __construct(
         public readonly string $nombre
    ){
    }
}