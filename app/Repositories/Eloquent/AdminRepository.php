<?php 

namespace App\Repositories\Eloquent;

use App\Models\Admin;
use App\Repositories\Interfaces\AdminRepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class AdminRepository implements AdminRepositoryInterface {
    public function findByUserId(int $userId): ?Admin {

        return Admin::where('user_id', $userId)->first();

    }

    public function findById(int $id): ?Admin {

        return Admin::findOrFail($id); 

    }

    public function getAll(int $page = 1, int $size = 10, array $filters = []): Paginator {

        $query = Admin::query();

        foreach ($filters as $key => $value) {
            $query->when($value, function ($q) use ($key, $value){
                $q->where($key, 'like', '%'.$value.'%');
            });
        }

        return $query->paginate($size, ['*'], 'page', $page);
    }

    public function create(array $data): Admin {
        return Admin::create($data);
    }

    public function update(int $id, array $data): bool {
        $Admin = Admin::find($id);

        if($Admin) {
            Admin::update($data);
        }

        return false;
    }

    public function delete(int $id): bool {
        $Admin = Admin::find($id);
        
        if ($Admin) {
            return $Admin->delete();
        }
        
        return false;
    }
}