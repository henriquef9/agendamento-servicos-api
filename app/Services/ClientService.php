<?php 

namespace App\Services;

use App\Dtos\Client\CreateClientDTO;
use App\Dtos\Client\UpdateClientDTO;
use App\Models\Client;
use App\Repositories\Interfaces\ClientRepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class ClientService {

    protected $clientRepository;

    public function __construct(
        ClientRepositoryInterface $clienteRepository,
    ){
        $this->clientRepository = $clienteRepository;
    }

    public function getById(string $id): ?Client {

        return $this->clientRepository->findById($id);

    }

    public function getByUserId(string $id): ?Client {

        return $this->clientRepository->findByUserId($id);

    }

    public function getAll(int $page = 1, int $size = 10, array $filters = []): Paginator {


        return $this->clientRepository->getAll($page, $size, $filters);

    }


    public function register(CreateClientDTO $clientDTO): Client {

        return $this->clientRepository->create($clientDTO);

    }

    public function update(UpdateClientDTO $data): bool {

        return $this->clientRepository->update($data);

    }

    
    public function delete(string $id): bool {

        return $this->clientRepository->delete($id);

    }

    public function uploadProfilePicture(string $id, string $path): bool {

        return $this->clientRepository->updateProfilePicture($id, $path);

    }

}    