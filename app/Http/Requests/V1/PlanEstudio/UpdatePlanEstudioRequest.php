<?php

namespace App\Http\Requests\V1\PlanEstudio;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlanEstudioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['sometimes', 'string', 'max:255'],
            'periodo_inicial' => ['sometimes', 'date'],
            'periodo_final' => ['sometimes', 'date', 'after:periodo_inicial'],
        ];
    }
}
