<?php

namespace App\Http\Controllers\Api;

use App\Dtos\Client\CreateClientDTO;
use App\Dtos\User\CreateUserDTO;
use App\Enums\Auth\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\StoreClientRequest;
use App\Http\Requests\Imagem\ImagemRequest;
use App\Services\ClientService;
use App\Services\ImagemUploadService;
use App\Services\UserService;

class ClientController extends Controller
{

    protected ClientService $clientService;
    protected UserService $userService;
    protected ImagemUploadService $imagemUploadService;


    public function __construct(ClientService $clientService, UserService $userService, ImagemUploadService $imagemUploadService) {
        $this->clientService = $clientService;
        $this->imagemUploadService = $imagemUploadService;
        $this->userService = $userService;
    }
    
    public function store(StoreClientRequest $request){

        $userDTO = CreateUserDTO::makefromRequest($request, UserRole::CLIENT);        
        $user = $this->userService->register($userDTO);

        $clientDTO = CreateClientDTO::makefromRequest($request, $user->id);
        $client = $this->clientService->register($clientDTO);
        
        return response()->json(['status' => 'success', 'message' => 'Conta criada com sucesso!', 'data' => $client] , 201);
      
    }

    public function uploadProfilePicture(ImagemRequest $request){

        $user = auth('')->user();
    
        $file = $request->file('file');

        $path = $this->imagemUploadService->upload($file, '/profile-picture/client');

        if(!$path){
            return response()->json(['status' => 'error', 'message' => 'Error durante upload de imagem de perfil.'], 500);
        }

        $url = $this->imagemUploadService->getUrl($path);

        $client = $this->clientService->getByUserId($user->id);

        $this->clientService->uploadProfilePicture($client->id, $path);  

        return response()->json(['status' => 'success', 'message' => 'Upload de imagem de perfil realizado com sucesso.', 'url' => $url], 201);

    }

}
