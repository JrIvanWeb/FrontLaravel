<?php

namespace App\Http\Requests\Profesor;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\DTOs\Profesor\UpdateProfesorDTO;

class UpdateRequest extends FormRequest
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
        ];
    }
    
    public function toDTO(): UpdateProfesorDTO
    {
        return new UpdateProfesorDTO(
            nombres: $this->nombres,
            apellidos: $this->apellidos
        );
    }
}
