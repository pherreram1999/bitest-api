<?php

namespace App\Http\Requests\V1\PlanEstudio;

use Illuminate\Foundation\Http\FormRequest;

class StorePlanEstudioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre'          => ['required', 'string', 'max:255'],
            'periodo_inicial' => ['required', 'date'],
            'periodo_final'   => ['required', 'date', 'after:periodo_inicial'],
            'carrera_id'      => ['required', 'integer', 'exists:carreras,id,deleted_at,NULL'],
        ];
    }
}
