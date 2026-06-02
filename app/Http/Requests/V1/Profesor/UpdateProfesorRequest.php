<?php

namespace App\Http\Requests\V1\Profesor;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfesorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre'  => ['sometimes', 'string', 'max:255'],
            'email'   => [
                'sometimes',
                'email',
                Rule::unique('profesores', 'email')
                    ->whereNull('deleted_at')
                    ->ignore($this->route('profesor')),
            ],
            'area_id' => ['sometimes', 'integer', 'exists:areas,id,deleted_at,NULL'],
        ];
    }
}
