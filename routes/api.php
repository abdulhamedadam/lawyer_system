<?php

use App\Http\Controllers\Api\CarBrandController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\GroubsControllers;
use App\Http\Controllers\Api\TransactionKiloSharController;
use App\Http\Controllers\Api\TripsController;
use App\Http\Controllers\Api\Settings;
use App\Http\Controllers\Api\TestApi;
use App\Http\Controllers\Api\UserapiController;
use App\Http\Controllers\Api\InvitationTripController;
use App\Http\Controllers\Api\TransactionKiloSharHistoryController;
use App\Http\Controllers\Api\ApiNotificationsController;
use App\Http\Controllers\Api\CarController;
use App\Http\Controllers\Api\AppDataController;

use Illuminate\Support\Facades\Route;


Route::post('/printpost', [TestApi::class, 'printpost']);
Route::get('/users', [TestApi::class, 'get_user_list']);
Route::post('/notifyUser', [TestApi::class, 'notifyUser']);

/* ----------------------------city------------------------------------*/
Route::get('/getcity/{search?}', [CityController::class, 'getcity']);


/* ----------------------------brand------------------------------------*/
Route::get('/carbrand/{search?}', [CarBrandController::class, 'getbrand']);

/*----------------------app_data-------------------------*/

Route::post('/contact_message', [AppDataController::class, 'contact_message']);
Route::get('/about_app', [AppDataController::class, 'about_app']);

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {

    Route::get('/login', function () {
        $status = 401;
        $array = ['error' => 'not login',
            'status' => $status
        ];
        return response($array, $status);
    });
    Route::post('/login', [UserapiController::class, 'login_user'])->name('login');
    Route::post('/add_user', [UserapiController::class, 'store']);
    Route::post('/checkExiteUser', [UserapiController::class, 'checkExiteUser']);
    Route::post('/checkExiteUsername', [UserapiController::class, 'checkExiteUsername']);
    Route::post('/checkExitePhone', [UserapiController::class, 'checkExitePhone']);
    Route::post('/checkExiteEmail', [UserapiController::class, 'checkExiteEmail']);
    Route::post('/checkExitePlateNumber', [UserapiController::class, 'checkExitePlateNumber']);
    Route::post('/update_password/{user_id}', [UserapiController::class, 'update_password']);
    Route::get('/createNewToken', [UserapiController::class, 'createNewToken']);
    Route::post('/logout', [UserapiController::class, 'logout']);


    Route::group([
        'middleware' => 'jwt'
    ], function ($router) {
        Route::post('/update_user/{user_id}', [UserapiController::class, 'update']);
        Route::post('/get_user/{user_id}', [UserapiController::class, 'show']);
        Route::post('/refreshToken', [UserapiController::class, 'refreshToken']);
        Route::get('/user-profile', [UserapiController::class, 'userProfile']);

    });
});

Route::group([
    'middleware' => 'jwt'
], function ($router) {

    /**-----------------------------**Groubs**----------------------------------------*/
    Route::post('/get_user_list', [GroubsControllers::class, 'get_user_list']);
    Route::post('/add_groub', [GroubsControllers::class, 'add_groub']);
    Route::post('/edit_groub/{groub_id}', [GroubsControllers::class, 'edit_groub']);


    Route::post('/add_users/{groub_id}', [GroubsControllers::class, 'add_users']);
    Route::post('/delete_users/{groub_id}', [GroubsControllers::class, 'delete_users']);

    Route::post('/accept_request', [GroubsControllers::class, 'accept_request']);
    Route::post('/refuse_request', [GroubsControllers::class, 'refuse_request']);
    Route::post('/get_users_requests', [GroubsControllers::class, 'get_users_requests']);
    Route::post('/get_users_Groubs', [GroubsControllers::class, 'get_users_Groubs']);
    Route::post('/get_one_Groubs', [GroubsControllers::class, 'get_one_Groubs']);


    Route::post('/add_groub_2', [GroubsControllers::class, 'add_groub_2']);
    Route::post('/add_users_2/{groub_id}', [GroubsControllers::class, 'add_users_2']);
    Route::post('/delete_users_2/{groub_id}', [GroubsControllers::class, 'delete_users_2']);

    Route::post('/count_all', [UserapiController::class, 'count_all']);



    /**-----------------------------**trips**----------------------------------------*/

    Route::post('/add_trips', [TripsController::class, 'add_trip']);
    Route::post('/edit_trip/{trip_id}', [TripsController::class, 'edit_trip']);
    Route::post('/cancel_trip/{trip_id}', [TripsController::class, 'cancel_trip']);
    Route::post('/trip_join_request/{trip_id}', [TripsController::class, 'trip_join_request']);

    Route::post('/accept_request_trip', [TripsController::class, 'accept_request_trip']);
    Route::post('/refuse_request_trip', [TripsController::class, 'refuse_request_trip']);
    Route::post('/get_users_trips', [TripsController::class, 'get_users_trips']);
    Route::post('/get_user_trips', [TripsController::class, 'get_user_trips']);

    /*Route::post('/accept_request_trip', [TripsController::class, 'accept_request_trip']);
    Route::post('/refuce_request_trip', [TripsController::class, 'refuce_request_trip']);
    */
    Route::post('/get_my_trips', [TripsController::class, 'get_my_trips']);


    Route::post('/get_trip_data', [TripsController::class, 'get_trip_data']);
    Route::post('/get_all_user_trip_requests', [TripsController::class, 'get_all_user_trip_requests']);
    Route::post('/get_all_user_trip_refused', [TripsController::class, 'get_all_user_trip_refused']);
    Route::post('/get_all_user_trip_accepted', [TripsController::class, 'get_all_user_trip_accepted']);

    Route::post('/search_trip', [TripsController::class, 'search_trip']);

    Route::post('/get_my_trips_today', [TripsController::class, 'get_my_trips_today']);
    Route::post('/get_user_trips_today', [TripsController::class, 'get_user_trips_today']);
    Route::post('/get_trip_day_data', [TripsController::class, 'get_trip_day_data']);
    Route::post('/get_gruop_trips', [TripsController::class, 'get_gruop_trips']);
    Route::post('/end_trip', [TripsController::class, 'end_trip']);



    /******************************TransactionKiloShar*******************************/
    Route::post('/transform_kiloshare', [TransactionKiloSharHistoryController::class, 'store']);
    Route::post('/admin_record_start', [TransactionKiloSharController::class, 'store']);
    Route::post('/user_record_confirm', [TransactionKiloSharController::class, 'update']);
    Route::post('/user_confirm_trip', [TransactionKiloSharController::class, 'edit']);
    Route::get('/user_transaction_history/{user_id}', [TransactionKiloSharController::class, 'show']);



    /******************************InvitationTrip *******************************/
    Route::post('/send_invitation', [InvitationTripController::class, 'store']);
    Route::post('/replay_invitation', [InvitationTripController::class, 'update']);
    Route::get('/user_invitation/{user_id}', [InvitationTripController::class, 'show']);
    Route::get('/my_invitation/{user_id}', [InvitationTripController::class, 'my_invitation']);
    Route::get('/cancel_invitation/{id}', [InvitationTripController::class, 'destroy']);

    /**------------------------------**notifications**---------------------------------**/
    Route::post('/get_user_notifications',[ApiNotificationsController::class,'get_user_notifications']);
    Route::post('/update_notification_read',[ApiNotificationsController::class,'update_notification_read']);

});

/**-----------------------------**settings**----------------------------------------*/

Route::post('/groub_type', [Settings::class, 'groub_type']);
Route::post('/carbrand_new', [CarBrandController::class, 'getbrand_new']);
Route::post('/getcity_new', [CityController::class, 'getcity_new']);
Route::get('/get_type_invitations', [InvitationTripController::class, 'get_type_invitations']);

//Route::get('/count_all/{user_id}', [UserapiController::class, 'count_all']);
/**-----------------------------**CarData**----------------------------------------*/
Route::post('/get_car_data', [CarController::class, 'get_car_data']);
Route::post('/edit_car_data', [CarController::class, 'edit_car_data']);
/**-----------------------------**AppData**----------------------------------------*/

