<?php

namespace App\Http\Requests\V1\UnidadAprendizaje;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUnidadAprendizajeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['sometimes', 'string', 'max:255'],
            'semestre' => ['sometimes', 'nullable', 'integer', 'min:1', 'max:12'],
            'carrera_id' => ['sometimes', 'integer', 'exists:carreras,id,deleted_at,NULL'],
            'plan_estudio_id' => ['sometimes', 'integer', 'exists:planes_estudio,id,deleted_at,NULL'],
        ];
    }
}
