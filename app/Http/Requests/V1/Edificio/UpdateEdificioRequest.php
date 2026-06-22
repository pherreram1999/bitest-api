<?php

namespace App\Http\Requests\V1\Edificio;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEdificioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'numero' => [
                'sometimes',
                'integer',
                'min:1',
                Rule::unique('edificios', 'numero')
                    ->whereNull('deleted_at')
                    ->ignore($this->route('edificio')),
            ],
            'nombre' => ['sometimes', 'string', 'max:255'],
        ];
    }
}
