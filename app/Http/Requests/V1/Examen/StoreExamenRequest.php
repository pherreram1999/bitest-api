<?php

namespace App\Http\Requests\V1\Examen;

use Illuminate\Foundation\Http\FormRequest;

class StoreExamenRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'descripcion' => ['required', 'string', 'max:255'],
            'horario' => ['required', 'date'],
            'activo' => ['sometimes', 'boolean'],
            'user_id' => ['required', 'integer', 'exists:users,id,deleted_at,NULL'],
            'unidad_aprendizaje_id' => ['required', 'integer', 'exists:unidades_aprendizaje,id,deleted_at,NULL'],
            'profesor_id' => ['required', 'integer', 'exists:profesores,id,deleted_at,NULL'],
            'salon_id' => ['required', 'integer', 'exists:salones,id,deleted_at,NULL'],
        ];
    }
}
