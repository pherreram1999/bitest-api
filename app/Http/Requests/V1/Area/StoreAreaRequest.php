<?php

namespace App\Http\Requests\V1\Area;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAreaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:255'],
            'clave' => ['required', 'string', 'max:255', Rule::unique('areas', 'clave')->whereNull('deleted_at')],
            'observaciones' => ['nullable', 'string'],
        ];
    }
}
