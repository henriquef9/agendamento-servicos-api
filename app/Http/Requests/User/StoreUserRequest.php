<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nome é obrigatório.',
            'name.max' => 'O nome não pode exceder 250 caracteres.',
            'email.required' => 'E-mail é obrigatório.',
            'email.unique' => 'Este e-mail já está registrado.',
            'email.email' => 'O e-mail fornecido é inválido.',
            'password.required' => "Senha é obrigatório.",
            'password.min' => "A senha deve ter no mínimo 6 caracteres."
        ];        
    }
}
