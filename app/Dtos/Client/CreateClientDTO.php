<?php 

namespace App\Dtos\Client;

use App\Http\Requests\Client\StoreClientRequest;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CreateClientDTO {

    public function __construct(
        public ?string $user_id,
        public ?string $cpf,
        public ?string $cnpj,
        public ?string $profile_picture,
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

    public static function makefromRequest(StoreClientRequest $request, ?string $id, ?string $pathProfilePicture){

        return new self(
            $id,
            $request->input('cpf'),
            $request->input('cnpj'),
            $pathProfilePicture,
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

}