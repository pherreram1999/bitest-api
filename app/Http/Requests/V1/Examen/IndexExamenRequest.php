<?php

namespace App\Http\Requests\V1\Examen;

use Illuminate\Foundation\Http\FormRequest;

class IndexExamenRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'descripcion' => ['sometimes', 'nullable', 'string', 'max:255'],
            'user_id' => ['sometimes', 'nullable', 'integer'],
            'unidad_aprendizaje_id' => ['sometimes', 'nullable', 'integer'],
            'profesor_id' => ['sometimes', 'nullable', 'integer'],
            'salon_id' => ['sometimes', 'nullable', 'integer'],
            'horario_desde' => ['sometimes', 'nullable', 'date'],
            'horario_hasta' => ['sometimes', 'nullable', 'date'],
        ];
    }
}
