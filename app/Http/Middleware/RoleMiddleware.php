<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        try{
            if(!$user = JWTAuth::parseToken()->authenticate()){
                return response()->json(['status'=> 'error', 'message' => 'Usuário não encontrado.'], 404);
            }
        } catch (JWTException $e){
            return response()->json(['status'=> 'error', 'message' => 'Token Inválido.'], 404);
        }
    
        if(!in_array($user->role, $roles)){
            return response()->json(['status' => 'error', 'message' => 'Acesso não autorizado.', 403]);
        }
        
        return $next($request);
    }
}
