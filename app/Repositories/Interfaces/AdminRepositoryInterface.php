<?php 

namespace App\Repositories\Interfaces;

use App\Models\Admin;
use Illuminate\Contracts\Pagination\Paginator;

interface AdminRepositoryInterface {

    public function findByUserId(int $userId): ?Admin;

    public function findById(int $id): ?Admin;

    public function getAll(int $page = 1, int $size = 10, array $filters = []): Paginator;

    public function create(array $data): Admin;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
    

}