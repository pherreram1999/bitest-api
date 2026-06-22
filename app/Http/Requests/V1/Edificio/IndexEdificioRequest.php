<?php

namespace App\Http\Requests\V1\Edificio;

use Illuminate\Foundation\Http\FormRequest;

class IndexEdificioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'numero' => ['sometimes', 'nullable', 'integer', 'min:1'],
            'nombre' => ['sometimes', 'nullable', 'string', 'max:255'],
        ];
    }
}
