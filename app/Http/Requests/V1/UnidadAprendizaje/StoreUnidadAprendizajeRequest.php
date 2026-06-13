<?php

namespace App\Http\Requests\V1\UnidadAprendizaje;

use Illuminate\Foundation\Http\FormRequest;

class StoreUnidadAprendizajeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:255'],
            'semestre' => ['nullable', 'integer', 'min:1', 'max:12'],
            'carrera_id' => ['required', 'integer', 'exists:carreras,id,deleted_at,NULL'],
            'plan_estudio_id' => ['required', 'integer', 'exists:planes_estudio,id,deleted_at,NULL'],
        ];
    }
}
