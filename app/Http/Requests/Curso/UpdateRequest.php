<?php

namespace App\Http\Requests\Curso;
use App\DTOs\Curso\UpdateCursoDTO;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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

    public function toDTO(): UpdateCursoDTO{
        return new UpdateCursoDTO(
            nombre: $this->nombre
        );
    }
}
