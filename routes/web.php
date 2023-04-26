<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Doctor\RegisterController;
use App\Http\Controllers\Doctor\TherapistController;
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
    Route::get('/', [HomeController::class, "index"])->name('site.home');
    Route::group(['prefix' => 'help'], function () {
        Route::get('/client', [HomeController::class, "helpClientIndex"])->name('help.client');
        Route::get('/therapy', [HomeController::class, "helpTherapyIndex"])->name('help.therapy');
    });
});

######################################## star therapist routes ###############################################

Route::group(["namespace" => "Doctor", "prefix" => "therapist"], function () {
    // routes can be visit as both 
    Route::get('/there-therapist', [RegisterController::class, "thereTherapist"]);

    // just not authenticated doctor can visit
    Route::get("/register", [RegisterController::class, "indexRegister"])
        ->middleware('register_therapist_visitor');
    Route::post("/register", [RegisterController::class, "register"])
        ->middleware('register_therapist_visitor');

    Route::group(['middleware' => 'guest'], function () {
        Route::get("/login", [RegisterController::class, "indexLogin"])->name('doctor.login');
        Route::post("/login", [RegisterController::class, "checkLogin"])->name('doctor.check.login');
    });

    // just authenticated doctor can visit
    Route::group(['middleware' => 'auth:doctor'], function () {
        Route::post("/send-code", [RegisterController::class, "sendVerfication"]);

        Route::get("/verify", [RegisterController::class, "indexVerify"])->middleware('verfiy');
        Route::post("/verify", [RegisterController::class, "verify"])->middleware('verfiy');

        Route::get("/information", [RegisterController::class, "indexInformation"])
            ->middleware('therapist_information_visitors');
        Route::post("/information", [RegisterController::class, "insertInformation"])
            ->middleware('therapist_information_visitors');

        Route::get("/payment", [RegisterController::class, "indexPayment"])
            ->middleware('therapist_payment_visitors');
        Route::post("/payment", [RegisterController::class, "insertPayment"])
            ->middleware('therapist_payment_visitors');

        Route::group(['middleware' => 'therapist_dashboard_vistors'], function () {
            Route::get('/', [TherapistController::class, 'index']);
            Route::get('/my-account', [TherapistController::class, 'indexMyAccount']);
        });

        Route::get('/pending', [TherapistController::class, 'indexPending'])
            ->middleware('therapist_pending_vistors');

        Route::get("/logout", [RegisterController::class, "logout"])->name('doctor.logout');
    });
    // ......................................
});

Route::get('/senfirebase', [TherapistController::class, 'sendTest']);
########################################### end doctor routes #################################################

Route::get('/testNotifications',  function () {
    return view('getnotification');
});
