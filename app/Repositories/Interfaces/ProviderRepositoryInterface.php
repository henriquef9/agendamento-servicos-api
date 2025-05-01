<?php 

namespace App\Repositories\Interfaces;

use App\Models\Provider;
use Illuminate\Contracts\Pagination\Paginator;

interface ProviderRepositoryInterface {

    public function findByUserId(int $userId): ?Provider;

    public function findById(int $id): ?Provider;

    public function getAll(int $page = 1, int $size = 10, array $filters = []): Paginator;

    public function create(array $data): Provider;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
    

}