<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\JWTAuthController;
use App\Http\Controllers\Api\ProviderController;
use App\Http\Middleware\JwtMiddleware;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth', 'as' => 'auth'], function(){

    Route::controller(JWTAuthController::class)->group( function() {
        Route::post('login', 'login')->name('login');
        Route::middleware([JwtMiddleware::class])->group( function (){
            Route::get('user-profile', 'getUser')->name('profile');
            Route::get('logout', 'logout')->name('logout');
        });

    });
});

Route::group(['prefix' => 'admin', 'as' => 'admin'], function() {

    Route::controller(AdminController::class)->group(function() {
        Route::post('', 'store')->name('create');
        Route::post('upload-profile-picture', 'uploadProfilePicture')->name('uploadProfile');
    });

});

Route::group(['prefix' => 'client', 'as' => 'client'], function() {

    Route::controller(ClientController::class)->group(function() {
        Route::post('', 'store')->name('create');
        Route::post('upload-profile-picture/{id}', 'uploadProfilePicture')->name('uploadProfile');
    });

});

Route::group(['prefix' => 'provider', 'as' => 'provider'], function() {

    Route::controller(ProviderController::class)->group(function() {
        Route::post('', 'store')->name('create');
    });

});



