<?php

namespace App\Http\Requests\Estudiante;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\DTOs\Estudiante\StoreEstudianteDTO;

class StoreRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

   
    public function rules(): array
    {
        return [
        'nombres' => 'required|string|max:255',
        'apellidos' => 'required|string|max:255',
        'curso_id' => 'required|integer|exists:curso,id',
        ];
    }

    public function toDTO(): StoreEstudianteDTO{
        return new StoreEstudianteDTO(
            nombres: $this->nombres,
            apellidos: $this->apellidos,
            curso_id: $this->curso_id
        );
    }
}
