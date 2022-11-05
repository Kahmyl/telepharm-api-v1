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
    Route::post('/appointments/{doctor_id}', [AppointmentController::class, 'store']);
    Route::get('/appointments', [AppointmentController::class, 'index']);
    Route::get('/appointment/{id}', [AppointmentController::class, 'show']);
    Route::get('/doctors', [AppointmentController::class, 'all_doctors']);



    // routes for doctors only
    Route::group(['middleware'=> 'is_doctor'], function(){
    });
    

});

Route::resource('resource', UserController::class);

