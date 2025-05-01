<?php

use App\Http\Controllers\Api\JWTAuthController;
use App\Http\Middleware\JwtMiddleware;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function(){
    Route::controller(JWTAuthController::class)->group( function() {
        
        Route::post('register', 'register');
        Route::post('login', 'login');

        Route::middleware([JwtMiddleware::class])->group( function (){
            Route::get('user-profile', 'getUser');
            Route::get('logout', 'logout');
        });
        
    });
});