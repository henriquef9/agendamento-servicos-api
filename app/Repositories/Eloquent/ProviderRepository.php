<?php 

namespace App\Repositories\Eloquent;

use App\Models\Provider;
use App\Repositories\Interfaces\ProviderRepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class ProviderRepository implements ProviderRepositoryInterface {

    public function findByUserId(int $userId): ?Provider {

        return Provider::where('user_id', $userId)->first();

    }

    public function findById(int $id): ?Provider {

        return Provider::findOrFail($id); 

    }

    public function getAll(int $page = 1, int $size = 10, array $filters = []): Paginator {

        $query = Provider::query();

        foreach ($filters as $key => $value) {
            $query->when($value, function ($q) use ($key, $value){
                $q->where($key, 'like', '%'.$value.'%');
            });
        }

        return $query->paginate($size, ['*'], 'page', $page);
    }

    public function create(array $data): Provider {
        return Provider::create($data);
    }

    public function update(int $id, array $data): bool {
        $provider = Provider::find($id);

        if($provider) {
            Provider::update($data);
        }

        return false;
    }

    public function delete(int $id): bool {
        $provider = Provider::find($id);
        
        if ($provider) {
            return $provider->delete();
        }
        
        return false;
    }

}