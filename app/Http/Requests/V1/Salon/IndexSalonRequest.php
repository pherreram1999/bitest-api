<?php

namespace App\Http\Requests\V1\Salon;

use Illuminate\Foundation\Http\FormRequest;

class IndexSalonRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['sometimes', 'nullable', 'string', 'max:255'],
            'edificio_id' => ['sometimes', 'nullable', 'integer'],
        ];
    }
}
