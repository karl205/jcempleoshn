<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
public function authorize(): bool
{
    return true;
}


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
{
    return [
        'name' => 'required|string|max:100',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|confirmed',
    ];
}

public function messages(): array
{
    return [
        'email.unique' => 'Este correo ya está registrado. Intenta iniciar sesión o recuperar tu contraseña.',
        'email.required' => 'El correo electrónico es obligatorio.',
        'email.email' => 'Ingresa un correo electrónico válido.',
        'password.required' => 'La contraseña es obligatoria.',
        'password.confirmed' => 'Las contraseñas no coinciden.',
    ];
}
}
