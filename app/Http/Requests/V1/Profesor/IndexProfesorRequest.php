<?php

namespace App\Http\Requests\V1\Profesor;

use Illuminate\Foundation\Http\FormRequest;

class IndexProfesorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['sometimes', 'nullable', 'string', 'max:255'],
            'email' => ['sometimes', 'nullable', 'string', 'max:255'],
            'area_id' => ['sometimes', 'nullable', 'integer'],
        ];
    }
}
