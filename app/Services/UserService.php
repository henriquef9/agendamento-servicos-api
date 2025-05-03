<?php 

namespace App\Services;

use App\Dtos\User\CreateUserDTO;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserService {

    protected $clientRepository;
    protected $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository
    ){
        $this->userRepository = $userRepository;
    }

    public function register(CreateUserDTO $userDTO): User {
        
        return $this->userRepository->create($userDTO);

    }

}    