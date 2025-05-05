<?php 

namespace App\Services;

use App\Dtos\User\CreateUserDTO;
use App\Dtos\User\UpdateUserDTO;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserService {

    protected $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository
    ){
        $this->userRepository = $userRepository;
    }

    public function register(CreateUserDTO $userDTO): User {
        
        return $this->userRepository->create($userDTO);

    }

    
    public function update(UpdateUserDTO $data): bool {

        return $this->userRepository->update($data);

    }

    public function delete(string $id): bool {

        return $this->userRepository->delete($id);

    }

}    