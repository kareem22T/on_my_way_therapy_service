<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Doctor\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

########################################## star doctor routes #################################################

Route::group(["namespace" => "Doctor", "prefix" => "doctor"], function () {
    // routes can be visit as both 
    Route::get('/there-doctor', [RegisterController::class, "thereDoctor"]);

    // just not authenticated doctor can visit
    Route::group(['middleware' => 'guest'], function () {
        Route::get("/register", [RegisterController::class, "indexRegister"]);
        Route::post("/register", [RegisterController::class, "register"]);
        Route::get("/login", [RegisterController::class, "indexLogin"])->name('doctor.login');
        Route::post("/login", [RegisterController::class, "checkLogin"])->name('doctor.check.login');
    });

    // just authenticated doctor can visit
    Route::group(['middleware' => 'auth:doctor'], function () {
    });
    // ......................................
});

########################################### end doctor routes #################################################