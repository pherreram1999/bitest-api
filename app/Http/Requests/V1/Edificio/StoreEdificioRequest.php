<?php

namespace App\Http\Requests\V1\Edificio;

use Illuminate\Foundation\Http\FormRequest;

class StoreEdificioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:255'],
        ];
    }
}
