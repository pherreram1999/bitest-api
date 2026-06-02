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
            'nombre'     => ['sometimes', 'string', 'max:255'],
            'carrera_id' => ['sometimes', 'integer', 'exists:carreras,id,deleted_at,NULL'],
        ];
    }
}
