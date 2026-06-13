<?php

namespace App\Http\Requests\V1\PlanEstudio;

use Illuminate\Foundation\Http\FormRequest;

class IndexPlanEstudioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['sometimes', 'nullable', 'string', 'max:255'],
            'periodo_inicial_desde' => ['sometimes', 'nullable', 'date'],
            'periodo_inicial_hasta' => ['sometimes', 'nullable', 'date'],
            'periodo_final_desde' => ['sometimes', 'nullable', 'date'],
            'periodo_final_hasta' => ['sometimes', 'nullable', 'date'],
        ];
    }
}
