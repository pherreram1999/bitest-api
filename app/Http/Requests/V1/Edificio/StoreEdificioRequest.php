<?php

namespace App\Http\Requests\V1\Edificio;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEdificioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'numero' => ['required', 'integer', 'min:1', Rule::unique('edificios', 'numero')->whereNull('deleted_at')],
            'nombre' => ['required', 'string', 'max:255'],
        ];
    }
}
