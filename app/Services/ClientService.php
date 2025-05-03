<?php 

namespace App\Services;

use App\Dtos\Client\CreateClientDTO;
use App\Models\Client;
use App\Repositories\Interfaces\ClientRepositoryInterface;

class ClientService {

    protected $clientRepository;

    public function __construct(
        ClientRepositoryInterface $clienteRepository,
    ){
        $this->clientRepository = $clienteRepository;
    }

    public function register(CreateClientDTO $clientDTO): Client {

        return $this->clientRepository->create($clientDTO);

    }

}    