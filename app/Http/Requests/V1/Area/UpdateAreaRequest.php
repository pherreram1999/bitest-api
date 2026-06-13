<?php

namespace App\Http\Requests\V1\Area;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAreaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['sometimes', 'string', 'max:255'],
            'clave' => [
                'sometimes',
                'string',
                'max:255',
                Rule::unique('areas', 'clave')
                    ->whereNull('deleted_at')
                    ->ignore($this->route('area')),
            ],
            'observaciones' => ['sometimes', 'nullable', 'string'],
        ];
    }
}
