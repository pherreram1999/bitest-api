<?php

namespace App\Http\Requests\V1\UnidadAprendizaje;

use Illuminate\Foundation\Http\FormRequest;

class IndexUnidadAprendizajeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['sometimes', 'nullable', 'string', 'max:255'],
            'semestre' => ['sometimes', 'nullable', 'integer', 'min:1', 'max:12'],
            'carrera_id' => ['sometimes', 'nullable', 'integer'],
            'plan_estudio_id' => ['sometimes', 'nullable', 'integer'],
        ];
    }
}
