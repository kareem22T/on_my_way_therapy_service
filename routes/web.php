<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\RegisterController as ClientRegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Doctor\RegisterController as TherapisRegisterController;
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
    Route::get('/there-therapist', [TherapisRegisterController::class, "thereTherapist"]);

    // just not authenticated doctor can visit
    Route::get("/register", [TherapisRegisterController::class, "indexRegister"])
        ->middleware('register_therapist_visitor');
    Route::post("/register", [TherapisRegisterController::class, "register"])
        ->middleware('register_therapist_visitor');

    Route::group(['middleware' => 'guest'], function () {
        Route::get("/login", [TherapisRegisterController::class, "indexLogin"])->name('doctor.login');
        Route::post("/login", [TherapisRegisterController::class, "checkLogin"])->name('doctor.check.login');
    });

    // just authenticated doctor can visit
    Route::group(['middleware' => 'auth:doctor'], function () {
        Route::post("/send-code", [TherapisRegisterController::class, "sendVerfication"]);

        Route::get("/verify", [TherapisRegisterController::class, "indexVerify"])->middleware('verfiy');
        Route::post("/verify", [TherapisRegisterController::class, "verify"])->middleware('verfiy');

        Route::get("/information", [TherapisRegisterController::class, "indexInformation"])
            ->middleware('therapist_information_visitors');
        Route::post("/information", [TherapisRegisterController::class, "insertInformation"])
            ->middleware('therapist_information_visitors');

        Route::get("/payment", [TherapisRegisterController::class, "indexPayment"])
            ->middleware('therapist_payment_visitors');
        Route::post("/payment", [TherapisRegisterController::class, "insertPayment"])
            ->middleware('therapist_payment_visitors');

        Route::group(['middleware' => 'therapist_dashboard_vistors'], function () {
            Route::get('/', [TherapistController::class, 'indexCalendar']);
            Route::post('/save-times', [TherapistController::class, 'saveWorkingTimes']);
            Route::get('/my-account', [TherapistController::class, 'indexMyAccount']);
            Route::get('/chats/{id?}', [TherapistController::class, 'indexChats']);
        });

        Route::get('/pending', [TherapistController::class, 'indexPending'])
            ->middleware('therapist_pending_vistors');

        Route::get("/logout", [TherapisRegisterController::class, "logout"])->name('doctor.logout');
    });
    // ......................................
});

########################################### end doctor routes #################################################

Route::post('/send-msg', [ChatController::class, 'send']);
Route::post('/seen', [ChatController::class, 'msgSeen']);
Route::get('/get-unseen', [ChatController::class, 'getUnseenAll']);
Route::post('/get-unseen-per-chat', [ChatController::class, 'getUseenPerChat']);
Route::post('/get-appointment', [ChatController::class, 'getAppointmentData']);
Route::post('/approve-appointment', [ChatController::class, 'approveAppointment']);
Route::post('/accept-appointment', [ChatController::class, 'acceptAppointment']);
Route::post('/edit-appointment', [ChatController::class, 'editAppointmentTime']);

######################################## star client routes ###############################################
Route::group(["namespace" => "client", "prefix" => "client"], function () {
    Route::group(['middleware' => 'guest'], function () {
        Route::get("/login", [ClientRegisterController::class, "indexLogin"])->name('client.login');
        Route::post("/login", [ClientRegisterController::class, "checkLogin"])->name('client.check.login');

        // just not authenticated cleint can visit
        Route::get("/register", [ClientRegisterController::class, "indexRegister"]);
        Route::post("/register", [ClientRegisterController::class, "register"]);
    });

    // just authenticated doctor can visit
    Route::group(['middleware' => 'auth:client'], function () {
        Route::get("/logout", [ClientRegisterController::class, "logout"])->name('client.logout');

        Route::group(['middleware' => 'client_dashboard_visitors'], function () {
            Route::post('/appointment', [ClientController::class, 'insertAppointment']);
            Route::post('/slots_approved', [ClientController::class, 'getSlotsApproved']);
            Route::get('/chats/{id?}', [ClientController::class, 'indexChats']);
            Route::get('/{username?}', [ClientController::class, 'index']);
            Route::post('/get-search-hints', [ClientController::class,'getSearchHints']);
        });
    });
    // ......................................
});
########################################### end client routes #################################################