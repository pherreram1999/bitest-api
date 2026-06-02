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
            'email'  => [
                'sometimes',
                'email',
                Rule::unique('areas', 'email')
                    ->whereNull('deleted_at')
                    ->ignore($this->route('area')),
            ],
        ];
    }
}
