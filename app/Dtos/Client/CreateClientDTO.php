<?php 

namespace App\Dtos\Client;

use App\Http\Requests\Client\StoreClientRequest;

class CreateClientDTO {

    public function __construct(
        public ?string $user_id,
        public ?string $cpf,
        public ?string $cnpj,
        public string $phone_number_1,
        public ?string $phone_number_2,
        public string $cep,
        public string $city,
        public string $state,
        public string $street,
        public string $district,
        public string $complement,
    )
    {
        
    }

    public static function makefromRequest(StoreClientRequest $request, ?string $id){

        return new self(
            $id,
            $request->input('cpf'),
            $request->input('cnpj'),
            $request->input('phone_number_1'),
            $request->input('phone_number_2'),
            $request->input('cep'),
            $request->input('city'),
            $request->input('state'),
            $request->input('street'),
            $request->input('district'),
            $request->input('complement'),
        );

    }

    public function toArray(): array
    {
        return array_filter(get_object_vars($this)); // remove nulls
    }

}