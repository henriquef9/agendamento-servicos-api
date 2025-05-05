<?php 

namespace App\Repositories\Interfaces;

use App\Dtos\Client\CreateClientDTO;
use App\Dtos\Client\UpdateClientDTO;
use App\Models\Client as Cliente;
use Illuminate\Contracts\Pagination\Paginator;

interface ClientRepositoryInterface {

    public function findByUserId(int $userId): ?Cliente;

    public function findById(int $id): ?Cliente;

    public function getAll(int $page = 1, int $size = 10, array $filters = []): Paginator;

    public function create(CreateClientDTO $data): Cliente;

    public function update(UpdateClientDTO $data): bool;

    public function delete(int $id): bool;
    
    public function updateProfilePicture(string $id, string $path): bool;
}