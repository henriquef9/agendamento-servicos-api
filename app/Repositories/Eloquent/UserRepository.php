<?php 

namespace App\Repositories\Eloquent;

use App\Dtos\User\CreateUserDTO;
use App\Dtos\User\UpdateUserDTO;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class UserRepository implements UserRepositoryInterface {

    public function findById(int $id): ?User {

        $user = User::findOrFail($id);

        return $user;

    }

    public function findByEmail(string $email): ?User {

        $user = User::where('email', $email)->first();

        return $user;
    }

    public function findByRole(string $role): ?User{

        $users = User::where('email', $role)->get();

        return $users;
    }

    public function getAll(int $page = 1, int $size = 10, array $filters = []): Paginator {

        $query = User::query();

        foreach ($filters as $key => $value) {
            $query->when($value, function ($q) use ($key, $value) {
                $q->where($key, 'like', '%'.$value.'%');
            });        
        }

        return $query->paginate($size, ['*'], 'page', $page);

    }

    public function create(CreateUserDTO $data): User {

        $user = User::create((array) $data);

        return $user;

    }

    public function update(UpdateUserDTO $data): bool {
        
        return User::update((array) $data);      
          
    }

    public function delete(int $id): bool {
        $user = User::find($id);
        
        if ($user) {
            return $user->delete();
        }
        
        return false;
    }

}