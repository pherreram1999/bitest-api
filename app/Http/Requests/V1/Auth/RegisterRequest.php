<?php

namespace App\Http\Requests\V1\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->whereNull('deleted_at')],
            'identificador' => ['required', 'string', 'max:50', Rule::unique('users', 'identificador')->whereNull('deleted_at')],
            'password' => ['required', 'confirmed', Password::min(8)],
            'rol' => ['sometimes', 'string', 'in:admin,administrativo,alumno'],
            'device_name' => ['required', 'string', 'max:255'],
        ];
    }
}
