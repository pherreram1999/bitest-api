<?php

namespace App\Http\Requests\V1\Edificio;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEdificioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['sometimes', 'string', 'max:255'],
        ];
    }
}
