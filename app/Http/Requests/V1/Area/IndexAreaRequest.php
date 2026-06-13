<?php

namespace App\Http\Requests\V1\Area;

use Illuminate\Foundation\Http\FormRequest;

class IndexAreaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['sometimes', 'nullable', 'string', 'max:255'],
            'clave' => ['sometimes', 'nullable', 'string', 'max:255'],
            'observaciones' => ['sometimes', 'nullable', 'string', 'max:255'],
        ];
    }
}
