<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Doctor\RegisterController;
use App\Http\Controllers\HomeController;

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

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [HomeController::class, "index"]);
    Route::group(['prefix' => 'help'], function () {
        Route::get('/client', [HomeController::class, "helpClientIndex"])->name('help.client');
        Route::get('/therapy', [HomeController::class, "helpTherapyIndex"])->name('help.therapy');
    });
});

######################################## star therapist routes ###############################################

Route::group(["namespace" => "Doctor", "prefix" => "therapist"], function () {
    // routes can be visit as both 
    Route::get('/there-doctor', [RegisterController::class, "thereDoctor"]);

    // just not authenticated doctor can visit
    Route::get("/register", [RegisterController::class, "indexRegister"])
        ->middleware('register_therapist_visitor');
    Route::post("/register", [RegisterController::class, "register"])
        ->middleware('register_therapist_visitor');
    Route::get("/verify", [RegisterController::class, "indexVerify"])->middleware('verfiy');

    Route::group(['middleware' => 'guest'], function () {
        Route::get("/login", [RegisterController::class, "indexLogin"])->name('doctor.login');
        Route::post("/login", [RegisterController::class, "checkLogin"])->name('doctor.check.login');
        Route::get("/information", [RegisterController::class, "indexInformation"]);
        Route::get("/payment", [RegisterController::class, "indexPayment"]);
    });

    // just authenticated doctor can visit
    Route::group(['middleware' => 'auth:doctor'], function () {
        Route::get('/', function () {
            return 'test';
        });
        Route::get("/logout", [RegisterController::class, "logout"])->name('doctor.logout');
        Route::get("/sendSms", [RegisterController::class, "phoneVerify"]);
    });
    // ......................................
});

########################################### end doctor routes #################################################