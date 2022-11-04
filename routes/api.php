<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Protected Routes
Route::group(['middleware' => ['auth:sanctum'] ], function(){

    // routes for doctors only
    Route::group(['middleware'=> 'is_doctor'], function(){
        Route::get('/products', function () {
            return 'products';
        });
    });
    

});

Route::resource('resource', UserController::class);

