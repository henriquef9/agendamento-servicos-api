<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateClientRequest extends FormRequest
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
        $clientId = $this->route('client'); 

        dd($clientId);

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $clientId,
            'password' => 'nullable|string|min:6',

            'cpf' => 'required_without:cnpj|string|size:11|unique:clients,cpf,' . $clientId,
            'cnpj' => 'required_without:cpf|string|size:14|unique:clients,cnpj,' . $clientId,
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phone_number_1' => 'required|string|size:11',
            'phone_number_2' => 'nullable|string|size:11',
            'cep' => 'required|string|size:8',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:2',
            'street' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'complement' => 'nullable|string|max:255',
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

    public function failedValidation(Validator $validator) { 

        throw new HttpResponseException(response()->json([ 

            'success' => false, 

            'message' => 'Erros de validação', 

            'errors' => $validator->errors() 

        ])); 

    } 
}
