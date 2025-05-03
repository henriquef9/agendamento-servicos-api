<?php

namespace App\Http\Controllers\Api;

use App\Dtos\Client\CreateClientDTO;
use App\Dtos\User\CreateUserDTO;
use App\Enums\Auth\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\StoreClientRequest;
use App\Services\ClientService;
use App\Services\ImagemService;
use App\Services\UserService;

class ClientController extends Controller
{

    protected $clientService;
    protected $userService;
    protected $imagemService;


    public function __construct(ClientService $clientService, UserService $userService, ImagemService $imagemService) {
        $this->clientService = $clientService;
        $this->imagemService = $imagemService;
        $this->userService = $userService;
    }
    
    public function store(StoreClientRequest $request){

     
        $pathProfilePicture = $this->imagemService->storeLocal($request->file('profile_picture'), 'ProfilePicture/Client');

        $userDTO = CreateUserDTO::makefromRequest($request, UserRole::CLIENT);        
        $user = $this->userService->register($userDTO);

        $clientDTO = CreateClientDTO::makefromRequest($request, $user->id, $pathProfilePicture);
        $client = $this->clientService->register($clientDTO);
        
        return response()->json(['status' => 'success', 'message' => 'Conta criada com sucesso!', 'clientDTO' => $clientDTO, 'userDTO' => $userDTO, 'data' => $client] , 201);
      
    }
}
