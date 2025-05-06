<?php 

namespace App\Dtos\User;

use App\Enums\Auth\UserRole;
use App\Http\Requests\User\UpdateUserRequest;

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

    public static function makefromRequest(UpdateUserRequest $request, ?UserRole $role){

        return new self(
            $request->input('user_id'),
            $request->input('name'),
            $request->input('email'),
            $request->input('password'),
            $role
        );

    }

    public function toArray(): array
    {
        return array_filter(get_object_vars($this)); // remove nulls
    }

}   