<?php

namespace App\Http\Requests\Curso;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\DTOs\Curso\StoreCursoDTO;

class StoreRequest extends FormRequest 
{
    
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array 
    {
        return[
            'nombre' => 'required|string|max:255',
        ];
    }

    public function toDTO(): StoreCursoDTO{
        return new StoreCursoDTO(
            nombre: $this->nombre
        );
    }
}