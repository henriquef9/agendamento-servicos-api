<?php

namespace App\Http\Requests\Client;

use App\Http\Requests\User\StoreUserRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreClientRequest extends StoreUserRequest
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
        return array_merge(Parent::rules(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',

            'cpf' => 'required_without:cnpj|string|size:11|unique:clients,cpf',
            'cnpj' => 'required_without:cpf|string|size:14|unique:clients,cnpj',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phone_number_1' => 'required|string|size:11',
            'phone_number_2' => 'nullable|string|size:11',
            'cep' => 'required|string|size:8',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:2',
            'street' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'complement' => 'nullable|string|max:255',
        ]);
    }

    public function messages(): array
    {
        return array_merge(parent::messages(), [
            'cpf.required_without' => 'CPF é obrigatório quando CNPJ não for informado.',
            'cnpj.required_without' => 'CNPJ é obrigatório quando CPF não for informado.',
        ]);    
    }

    public function failedValidation(Validator $validator) { 

        throw new HttpResponseException(response()->json([ 

            'status' => 'error', 

            'message' => 'Erros de validação', 

            'errors' => $validator->errors() 

        ])); 

    } 
}
