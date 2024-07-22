<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {

    Route::controller(AuthController::class)->group(function () {
        Route::post('/auth/register',  'register');
        Route::post('/auth/login', 'login');
        Route::post('/auth/logout', 'logout')->middleware('auth:sanctum');
        Route::post('/auth/verify', 'verify')->middleware('auth:sanctum');
        Route::post('/auth/resend/code', 'resendCode');
        Route::post('/auth/password/reset-code/send', 'sendResetCode');
        Route::post('/auth/password/reset-code/check', 'checkResetCode');
        Route::post('/auth/forget-password', 'forget_password');
        Route::post('/auth/password/reset', 'newPasswordstore')->name('password.resetApi');

        Route::post('/get/user', 'userInfo')->middleware('auth:sanctum');
        Route::post('/user/update', 'updateProfile')->middleware('auth:sanctum');
    });

    Route::middleware('auth:sanctum')->group(function () {


    });
});
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
