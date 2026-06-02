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
            'email'  => ['required', 'email', Rule::unique('areas', 'email')->whereNull('deleted_at')],
        ];
    }
}
