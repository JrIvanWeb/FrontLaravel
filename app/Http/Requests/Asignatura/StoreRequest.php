<?php

namespace App\Http\Requests\Asignatura;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\DTOs\Asignatura\StoreAsignaturaDTO;

class StoreRequest extends FormRequest
{
  
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255',
        ];
    }

    public function toDTO():StoreAsignaturaDTO{
        return new StoreAsignaturaDTO(
            nombre: $this->nombre
        );
    }

}
