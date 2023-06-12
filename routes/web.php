<?php

use App\Events\NotificationEvent;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\RegisterController as ClientRegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Doctor\RegisterController as TherapisRegisterController;
use App\Http\Controllers\Admin\MainController as AdminMainController;
use App\Http\Controllers\Admin\RegisterController as AdminRegisterController;
use App\Http\Controllers\Client\AssessmentController;
use App\Http\Controllers\Doctor\TherapistController;
use App\Http\Controllers\FullCalenderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;

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

Route::get('/specialization/1', function () {
    return view('site.professions.Physiotherapy');
});
Route::get('/specialization/2', function () {
    return view('site.professions.speech');
});
Route::get('/specialization/3', function () {
    return view('site.professions.Podiatry');
});
Route::get('/specialization/4', function () {
    return view('site.professions.Occupational');
});
Route::get('/specialization/5', function () {
    return view('site.professions.Behavior');
});
Route::get('/specialization/6', function () {
    return view('site.professions.Psychology');
});
Route::get('/specialization/7', function () {
    return view('site.professions.Exercise');
});
Route::get('/specialization/8', function () {
    return view('site.professions.Dietetics');
});

######################################## start therapist routes ###############################################

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

        Route::post('/check-registration-info', [TherapisRegisterController::class, "checkRegistrationInfo"]);
        Route::post("/send-code", [TherapisRegisterController::class, "sendVerfication"]);
    });

    // just authenticated doctor can visit
    Route::group(['middleware' => 'auth:doctor'], function () {

        Route::get("/set-password", [TherapisRegisterController::class, "indexPasswordSet"])->middleware('password_set');
        Route::post("/set-password", [TherapisRegisterController::class, "setPassword"])->middleware('password_set');

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
            Route::post('/edit-times', [TherapistController::class, 'editWorkingTimes']);
            Route::get('/my-account', [TherapistController::class, 'indexMyAccount']);
            Route::get('/my-account/profile', [TherapistController::class, 'indexProfile']);
            Route::get('/chats/{id?}', [TherapistController::class, 'indexChats']);
            Route::get('/appointment/{id?}', [TherapistController::class, 'appointmentDetails']);
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
Route::post('/cancel-appointment', [ChatController::class, 'cancelAppointment']);
Route::post('/edit-appointment', [ChatController::class, 'editAppointmentTime']);
Route::get('/get-notifications', [NotificationController::class, 'getNotifications']);
Route::post('/get-notifications-appointment', [NotificationController::class, 'getAppointmentData']);
Route::get('/get-unseen-notification', [NotificationController::class, 'getUnseenNotification']);
Route::get('/seen-notification', [NotificationController::class, 'seenNotifiction']);
Route::post('/startMove', [ChatController::class, 'startMove']);
Route::post('/arrived', [ChatController::class, 'arrived']);
Route::post('/complete', [ChatController::class, 'complete']);

######################################## star client routes ###############################################
Route::group(["namespace" => "client", "prefix" => "client"], function () {
    Route::group(['middleware' => 'guest'], function () {
        Route::get("/login", [ClientRegisterController::class, "indexLogin"])->name('client.login');
        Route::post("/login", [ClientRegisterController::class, "checkLogin"])->name('client.check.login');

        // just not authenticated cleint can visit
        Route::get("/register", [ClientRegisterController::class, "indexRegister"]);
        Route::post("/register", [ClientRegisterController::class, "register"]);
        Route::post("/check-info", [ClientRegisterController::class, "checkInfo"]);
    });
    Route::post('/send-code', [ClientRegisterController::class, 'sendVerfication']);
    // just authenticated doctor can visit
    Route::group(['middleware' => 'auth:client'], function () {
        Route::get("/logout", [ClientRegisterController::class, "logout"])->name('client.logout');

        Route::group(['middleware' => 'client_dashboard_visitors'], function () {
            Route::post('/appointment', [ClientController::class, 'insertAppointment']);
            Route::post('/slots_approved', [ClientController::class, 'getSlotsApproved']);
            Route::get('/chats/{id?}', [ClientController::class, 'indexChats']);
            Route::get('/account', [ClientController::class, 'indexAccount']);
            Route::get('/{username?}', [ClientController::class, 'index']);
            Route::post('/get-search-hints', [ClientController::class, 'getSearchHints']);
            Route::get('/check/assessments', [ClientController::class, 'checkAssessmentsDone']);
            Route::get('/NDIS/Service-Agreement', [AssessmentController::class, 'serviceAgreementIndex'])->middleware('service_agreement_visitors');
            Route::get('/assessment/risk', [AssessmentController::class, 'riskAssessmentIndex'])->middleware('risk_assessment_visitors');
        });
    });
    // ......................................
});
########################################### end client routes #################################################

########################################### start admin routes ################################################
Route::group(['namespace' => 'admin', 'prefix' => 'admin'], function () {
    Route::get("/login", [AdminRegisterController::class, "indexLogin"])->name('admin.login')->middleware('guest');
    Route::post("/login", [AdminRegisterController::class, "checkLogin"])->name('admin.check.login');
    Route::get("/logout", [AdminRegisterController::class, "logout"]);
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('/', [AdminMainController::class, 'usersClientIndex']);
        Route::get('/therapists', [AdminMainController::class, 'usersTherapistsIndex']);
        Route::get('/sessions', [AdminMainController::class, 'sessionsIndex']);
        Route::get('/therapists-preview', [AdminMainController::class, 'usersTherapistsPreviewIndex']);
        Route::get('/therapists/request/{id}', [AdminMainController::class, 'returnTherapistRequest']);
        Route::post('/therapists-approve', [AdminMainController::class, 'approveTherapist']);
        Route::post('/therapists-delete', [AdminMainController::class, 'deleteTherapist']);
    });
});
