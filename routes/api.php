<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\UserController;
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
Route::group(['middleware' => 'auth:api,apiadmin'], function () {
    Route::post('changePassword', [UserController::class, 'changePassword']);
    Route::apiResource('user', UserController::class);
    Route::apiResource('post', PostController::class);
    
});

Route::group(['middleware' => 'auth:apiadmin'], function () {
    Route::post('test',function(){
        return '123';
    });
});

Route::post('login', [AuthController::class, 'login']);

Route::post('refresh', [AuthController::class, 'refresh']);



Route::put('forgetpassword', [UserController::class, 'forgetPassword']);