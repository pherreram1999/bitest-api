<?php

namespace App\Http\Requests\V1\Profesor;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProfesorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre'  => ['required', 'string', 'max:255'],
            'email'   => ['required', 'email', Rule::unique('profesores', 'email')->whereNull('deleted_at')],
            'area_id' => ['required', 'integer', 'exists:areas,id,deleted_at,NULL'],
        ];
    }
}
