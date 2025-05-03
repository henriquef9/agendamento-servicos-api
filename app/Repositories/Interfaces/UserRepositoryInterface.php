<?php 

namespace App\Repositories\Interfaces;

use App\Dtos\User\CreateUserDTO;
use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;

interface UserRepositoryInterface {

    public function findById(int $id): ?User;

    public function findByEmail(string $email): ?User;

    public function findByRole(string $role): ?User;

    public function getAll(int $page = 1, int $size = 10, array $filters = []): Paginator;

    public function create(CreateUserDTO $data): User;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
    
}