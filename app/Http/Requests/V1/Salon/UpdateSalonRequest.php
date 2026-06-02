<?php

namespace App\Http\Requests\V1\Salon;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSalonRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre'      => ['sometimes', 'string', 'max:255'],
            'edificio_id' => ['sometimes', 'integer', 'exists:edificios,id,deleted_at,NULL'],
        ];
    }
}
