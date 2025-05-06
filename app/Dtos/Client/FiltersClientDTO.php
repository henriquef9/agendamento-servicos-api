<?php 

namespace App\Dtos\Client;

use App\Http\Requests\Client\StoreClientRequest;
use Illuminate\Http\Request;

class FiltersClientDTO {

    public function __construct(
        public ?string $name,
        public ?string $email,
        public ?string $cpf,
        public ?string $cnpj,
        public string $cep,
        public string $city,
        public string $state,
        public string $street,
        public string $district,
    )
    {
        
    }

    public static function makefromRequest(Request $request){

        return new self(
            $request->input('name'),
            $request->input('email'),
            $request->input('cpf'),
            $request->input('cnpj'),
            $request->input('cep'),
            $request->input('city'),
            $request->input('state'),
            $request->input('street'),
            $request->input('district'),
        );

    }

    public function toArray(): array
    {
        return array_filter(get_object_vars($this)); // remove nulls
    }

}