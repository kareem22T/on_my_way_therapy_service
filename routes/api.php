<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\RegisterController as ClientRegisterController;


Route::group(['middleware' => 'api_password_middleware'], function () {
    Route::group(['prefix' => '/client'], function () {
        Route::post('/login', [ClientRegisterController::class, 'jwtLogin']);
    });
});
