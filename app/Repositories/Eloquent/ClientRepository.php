<?php

namespace App\Repositories\Eloquent;

use App\Dtos\Client\CreateClientDTO;
use App\Dtos\Client\UpdateClientDTO;
use App\Models\Client;
use App\Repositories\Interfaces\ClientRepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class ClientRepository implements ClientRepositoryInterface {

    public function findByUserId(int $userId): ?Client {

        return Client::where('user_id', $userId)->first();

    }

    public function findById(int $id): ?Client {

        return Client::findOrFail($id);  

    }

    public function getAll(int $page = 1, int $size = 10, array $filters = []): Paginator {

        $query = Client::query();

        foreach ($filters as $key => $value) {
            if (in_array($key, ['name', 'email'])) {
                $query->whereHas('user', function ($q) use ($key, $value) {
                    $q->where($key, 'like', "%{$value}%");
                });
            } else {
                $query->when($value, function ($q) use ($key, $value) {
                    $q->where($key, 'like', "%{$value}%");
                });
            }
        }

        return $query->paginate($size, ['*'], 'page', $page);
    }

    public function create(CreateClientDTO $data): Client {
        return Client::create((array) $data);
    }

    public function update(UpdateClientDTO $data): bool {

        $client = Client::find($data->id);

        if (!$client) {
            return false;
        }
    
        return $client->update($data->toArray());

    }

    public function delete(int $id): bool {
        $Client = Client::find($id);
        
        if ($Client) {
            return $Client->delete();
        }
        
        return false;
    }

    public function updateProfilePicture(string $id, string $path): bool {

        $client = Client::find($id);

        if (!$client) {
            return false;
        }
    
        return $client->update([
            'profile_picture' => $path,
        ]);

    }


}