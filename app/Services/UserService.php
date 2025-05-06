<?php 

namespace App\Services;

use App\Dtos\User\CreateUserDTO;
use App\Dtos\User\UpdateUserDTO;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class UserService {

    protected $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository
    ){
        $this->userRepository = $userRepository;
    }

    public function getById(string $id): User {

        return $this->userRepository->findById($id);

    }

    public function getByEmail(string $email): ?User {

        return $this->userRepository->findByEmail($email);

    }

    public function getByRole(string $role): ?User{

        return $this->userRepository->findByRole($role);

    }

    public function getAll(int $page = 1, int $size = 10, array $filters = []): Paginator {


        return $this->userRepository->getAll($page, $size, $filters);

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