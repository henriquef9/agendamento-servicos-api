<?php 

namespace App\Repositories\Interfaces;

use App\Dtos\Client\CreateClientDTO;
use App\Models\Client as Cliente;
use Illuminate\Contracts\Pagination\Paginator;

interface ClientRepositoryInterface {

    public function findByUserId(int $userId): ?Cliente;

    public function findById(int $id): ?Cliente;

    public function getAll(int $page = 1, int $size = 10, array $filters = []): Paginator;

    public function create(CreateClientDTO $data): Cliente;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
    

}