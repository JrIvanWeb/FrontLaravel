<?php

namespace App\Http\Requests\Estudiante;

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
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'curso_id' => 'required|integer|exists:curso,id',
        ];
    }
}
