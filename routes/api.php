<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ClinicianController;
use App\Http\Controllers\Api\StripeController;
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

        Route::controller(ClinicianController::class)->group(function () {
            Route::post('/get/user', 'userInfo');
            Route::post('/user/update', 'updateProfile');
            Route::post('/documents/upload', 'documentUpload');
            Route::post('/document/types', 'documentType');
            Route::post('/user/documents', 'userDocuments');
            Route::post('/w9/form', 'w9Form');
            Route::post('/bca/form', 'bcaForm');
            Route::post('/deposit/form', 'depositForm');
            Route::post('/get/unread/notifications', 'getUnreadNotifications');
            Route::post('/get/read/notifications', 'getReadNotifications');
            Route::post('/mark/notification/read', 'markAsReadNotification');
        });

        Route::controller(StripeController::class)->group(function () {
            Route::post('/stripe/register/connect/account',  'stripeConnectedAccount');
            Route::post('/stripe/login/connect/account',  'stripeConnectedAccountLogin');
            Route::get('/stripe/oauth',   'oauth');
            Route::post('/stripe/oauth/authentication',   'authenticate');
        });
    });
});
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
