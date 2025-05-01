<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class JWTAuthController extends Controller
{
    public function register(RegisterRequest $request){
        
     
        // tratamento de erros
        $user = User::create([
            'name' => $request->input("name"),
            'email' => $request->input("email"),
            'password' => Hash::make($request->input("password")),
            'role' => $request->input('role')
        ]);

        // tratamento de erros
        $token = JWTAuth::claims(['role' => $user->role])->fromUser($user);
        
        return response()->json(compact('user','token'), 200);

    }

    public function login(LoginRequest $request){

        // tratamento de erros
        $credentials = $request->only('email', 'password');

        try {
            if(!$token = JWTAuth::attempt($credentials)){
                return response()->json(['success' => false, 'message' => 'Credencias Inválida!'], 401);
            }

            // retorna usuário (user) autenticado
            $user = auth('')->user();

            // tratamento de erros
            $token = JWTAuth::claims(['role' => $user->role])->fromUser($user);    
            
            // tratamento de erros
            //$token = JWTAuth::fromUser($user);
  
            return response()->json(compact('token'), 200);

        }catch (JWTException $e){
            return response()->json(['success'=> false, 'message' => 'Não foi possível fazer login. Tente novamente!'], 500);
        }

    }

    // recuperar dados do usuário autenticado
    public function getUser() {
        try{
            if(!$user = JWTAuth::parseToken()->authenticate()){
                return response()->json(['success'=> false, 'message' => 'Usuário não encontrado.'], 404);
            }
        } catch (JWTException $e){
            return response()->json(['success'=> false, 'message' => 'Token Inválido.'], 404);
        }

        return response()->json(compact('user'));
    }

    // logout de usuário
    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json(['success' => true, 'message' => 'Sucesso ao deslogar!'], 200);

    }

}
