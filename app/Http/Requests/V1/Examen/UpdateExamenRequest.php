<?php

namespace App\Http\Requests\V1\Examen;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExamenRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'descripcion' => ['sometimes', 'string', 'max:255'],
            'horario' => ['sometimes', 'date'],
            'activo' => ['sometimes', 'boolean'],
            'user_id' => ['sometimes', 'integer', 'exists:users,id,deleted_at,NULL'],
            'unidad_aprendizaje_id' => ['sometimes', 'integer', 'exists:unidades_aprendizaje,id,deleted_at,NULL'],
            'profesor_id' => ['sometimes', 'integer', 'exists:profesores,id,deleted_at,NULL'],
            'salon_id' => ['sometimes', 'integer', 'exists:salones,id,deleted_at,NULL'],
        ];
    }
}
