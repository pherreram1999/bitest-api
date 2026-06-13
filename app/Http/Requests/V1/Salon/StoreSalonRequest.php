<?php

namespace App\Http\Requests\V1\Salon;

use Illuminate\Foundation\Http\FormRequest;

class StoreSalonRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:255'],
            'edificio_id' => ['required', 'integer', 'exists:edificios,id,deleted_at,NULL'],
        ];
    }
}
