<?php

namespace App\Http\Requests\V1\Carrera;

use Illuminate\Foundation\Http\FormRequest;

class IndexCarreraRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['sometimes', 'nullable', 'string', 'max:255'],
        ];
    }
}
