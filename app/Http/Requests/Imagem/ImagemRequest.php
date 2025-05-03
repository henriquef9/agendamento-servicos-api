<?php

namespace App\Http\Requests\Imagem;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ImagemRequest extends FormRequest
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
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    
    public function messages(): array
    {
        return [
            'file.required' => 'Imagem é obrigatório.',
            'cnpj.image' => 'Arquivo não é uma imagem.',
            'cnpj.mimes' => 'Não é uma imagem válida.',
        ];  
    }

    public function failedValidation(Validator $validator) { 

        throw new HttpResponseException(response()->json([ 

            'status' => 'error', 

            'message' => 'Erros de validação', 

            'errors' => $validator->errors() 

        ])); 

    } 
}
