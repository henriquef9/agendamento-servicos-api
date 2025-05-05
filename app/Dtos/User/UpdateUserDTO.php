<?php 

namespace App\Dtos\User;

use App\Enums\Auth\UserRole;
use App\Http\Requests\User\StoreUserRequest;

class UpdateUserDTO {

    public function __construct(
        public string $id,
        public string $name,
        public string $email,
        public ?string $password,
        public ?UserRole $role,
    )
    {
        
    }

    public static function makefromRequest(StoreUserRequest $request, string $id, ?UserRole $role){

        return new self(
            $id,
            $request->input('name'),
            $request->input('email'),
            $request->input('password'),
            $role
        );

    }

}   