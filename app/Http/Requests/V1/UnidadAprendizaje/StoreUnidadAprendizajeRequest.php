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
            'nombre'     => ['required', 'string', 'max:255'],
            'carrera_id' => ['required', 'integer', 'exists:carreras,id,deleted_at,NULL'],
        ];
    }
}
