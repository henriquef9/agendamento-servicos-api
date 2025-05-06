<?php

namespace App\Http\Controllers\Api;

use App\Dtos\Client\CreateClientDTO;
use App\Dtos\Client\FiltersClientDTO;
use App\Dtos\Client\UpdateClientDTO;
use App\Dtos\User\CreateUserDTO;
use App\Dtos\User\UpdateUserDTO;
use App\Enums\Auth\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\StoreClientRequest;
use App\Http\Requests\Client\UpdateClientRequest;
use App\Http\Requests\Imagem\ImagemRequest;
use App\Services\ClientService;
use App\Services\ImagemUploadService;
use App\Services\UserService;
use Illuminate\Http\Request;

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


    public function getById(string $id){

        $client = $this->clientService->getById($id);

        return response()->json(['status' => 'success', 'clients' => $client] , 200);

    }

    public function getByUserId(string $id){

        $client = $this->clientService->getByUserId($id);

        return response()->json(['status' => 'success', 'clients' => $client] , 200);

    }

    public function getAll(Request $request){

        $filters = FiltersClientDTO::makefromRequest($request);
        $page = $request->input('page', 0);
        $size = $request->input('size', 10);

        $clients = $this->clientService->getAll($page, $size, $filters->toArray());

        return response()->json(['status' => 'success', 'clients' => $clients] , 200);

    }
    
    public function store(StoreClientRequest $request){

        $userDTO = CreateUserDTO::makefromRequest($request, UserRole::CLIENT);        
        $user = $this->userService->register($userDTO);

        $clientDTO = CreateClientDTO::makefromRequest($request, $user->id);
        $client = $this->clientService->register($clientDTO);

        $client = $client->load('user');
        
        return response()->json(['status' => 'success', 'message' => 'Conta criada com sucesso!', 'data' => $client] , 201);
      
    }

    public function update(UpdateClientRequest $request){

        
        $userDTO = UpdateUserDTO::makefromRequest($request, UserRole::CLIENT);        
        $user = $this->userService->update($userDTO);

        $clientDTO = UpdateClientDTO::makefromRequest($request, null);
        $client = $this->clientService->update($clientDTO);

        if(!$client || !$user){
            return response()->json(['status' => 'error', 'message' => 'Não foi possível atualizar dados da conta.'] , 500);
        }

        return response()->json(['status' => 'success', 'message' => 'Conta atualizada com sucesso!'] , 200);

    }

    public function delete(string $id) {

        $client = $this->clientService->getById($id);

        if($client->profile_picture){  $this->imagemUploadService->delete($client->profile_picture); }

        $delete_confirms = $this->userService->delete($client->user_id);

        if(!$delete_confirms){
            return response()->json(['status' => 'error', 'message' => 'Não foi possível deletar cliente.'] , 500);
        }

        return response()->json(['status' => 'success', 'message' => 'Cliente deletado com sucesso.'] , 200);

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

        if($client->profile_picture){
            $this->imagemUploadService->delete($client->profile_picture);
        }

        $this->clientService->uploadProfilePicture($client->id, $path);  

        return response()->json(['status' => 'success', 'message' => 'Upload de imagem de perfil realizado com sucesso.', 'url' => $url], 201);

    }



}
