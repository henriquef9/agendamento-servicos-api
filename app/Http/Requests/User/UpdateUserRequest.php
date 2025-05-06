<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        $userId = $this->input('user_id');

        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($userId),
            ],
            'password' => 'nullable|string|min:6', 
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nome é obrigatório.',
            'name.max' => 'O nome não pode exceder 255 caracteres.',
            'email.required' => 'E-mail é obrigatório.',
            'email.unique' => 'Este e-mail já está registrado por outro usuário.',
            'email.email' => 'O e-mail fornecido é inválido.',
            'password.min' => 'A senha deve ter no mínimo 6 caracteres.',
        ];
    }
}
