<?php 

namespace App\Dtos\User;

use App\Enums\Auth\UserRole;
use App\Http\Requests\User\StoreUserRequest;

class CreateUserDTO {

    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public UserRole $role,
    )
    {
        
    }

    public static function makefromRequest(StoreUserRequest $request, UserRole $role){

        return new self(
            $request->input('name'),
            $request->input('email'),
            $request->input('password'),
            $role
        );

    }

}   