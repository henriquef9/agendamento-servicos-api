<?php

use Illuminate\Support\Facades\Route;

Route::get('/user', function () {
    $data = [ 'id' => 1, 'nome' => 'Henrique'];
    return response()->json($data, 401);
});


