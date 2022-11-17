<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Protected Routes
Route::group(['middleware' => ['auth:sanctum'] ], function(){
    Route::post('/appointments', [AppointmentController::class, 'store']);
    Route::get('/appointments', [AppointmentController::class, 'index']);
    Route::get('/appointment/{id}', [AppointmentController::class, 'show']);
    Route::get('/doctors', [AppointmentController::class, 'all_doctors']);
    Route::get('/auth', [AppointmentController::class, 'x']);
    Route::post('/logout', [UserController::class, 'logout']);



    // routes for doctors only
    Route::group(['middleware'=> 'is_doctor'], function(){
        Route::post('/doctor/appointment/{appointment_id}', [AppointmentController::class, 'accept_or_decline_appointment']);
    });
    

});

Route::resource('resource', UserController::class);

