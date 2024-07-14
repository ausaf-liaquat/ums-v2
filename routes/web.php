<?php

use App\Http\Controllers\Backend\MasterFiles\ColorController;
use App\Http\Controllers\Backend\MasterFiles\SizeController;
use App\Http\Controllers\Backend\Products\ProductController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\LanguageController;
use App\Livewire\Privacy;
use App\Livewire\Terms;
use Illuminate\Support\Facades\Route;

/*
*
* Auth Routes
*
* --------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';

//   ____
// /  ___|___  _ __ ___  _ __ ___   ___  _ __
// | |   / _ \| '_ ` _ \| '_ ` _ \ / _ \| '_ \
// | |__| (_) | | | | | | | | | | | (_) | | | |
// \____\___/|_| |_| |_|_| |_| |_|\___/|_| |_|

// home route
Route::get('home', [FrontendController::class, 'index'])->name('home');

// Language Switch
Route::get('language/{language}', [LanguageController::class, 'switch'])->name('language.switch');

Route::get('dashboard', 'App\Http\Controllers\Frontend\FrontendController@index')->name('dashboard');

// pages
Route::get('terms', Terms::class)->name('terms');
Route::get('privacy', Privacy::class)->name('privacy');



//  ____        _       _____     _     _
// |  _ \  __ _| |_ __ |_   _|_ _| |__ | | ___
// | | | |/ _` | __/ _` || |/ _` | '_ \| |/ _ \
// | |_| | (_| | || (_| || | (_| | |_) | |  __/
// |____/ \__,_|\__\__,_||_|\__,_|_.__/|_|\___|

Route::get('colors/dataTable', [ColorController::class, 'dataTable'])->name('colors.dataTable');
Route::get('sizes/dataTable', [SizeController::class, 'dataTable'])->name('sizes.dataTable');
Route::get('products/dataTable', [ProductController::class, 'dataTable'])->name('products.dataTable');

//     _     _
//    / \   (_) __ ___  __
//   / _ \  | |/ _` \ \/ /
//  /  ___ \ | | (_| |> <
// /_/   \_\/ |\__,_/_/\_\
//        |__/
Route::controller(ColorController::class)->group(function () {
    Route::get('product/name-unique', 'productNameValidator')->name('product.validator');
});


//  _____ ____   ___  _   _ _____ _____ _   _ ____
// |  ___|  _ \ / _ \| \ | |_   _| ____| \ | |  _ \
// | |_  | |_) | | | |  \| | | | |  _| |  \| | | | |
// |  _| |  _ <| |_| | |\  | | | | |___| |\  | |_| |
// |_|   |_| \_\\___/|_| \_| |_| |_____|_| \_|____/

Route::group(['namespace' => 'App\Http\Controllers\Frontend', 'as' => 'frontend.'], function () {
    Route::get('/', 'FrontendController@index')->name('index');

    Route::group(['middleware' => ['auth']], function () {
        /*
        *
        *  Users Routes
        *
        * ---------------------------------------------------------------------
        */
        $module_name = 'users';
        $controller_name = 'UserController';
        Route::get('profile/edit', ['as' => "{$module_name}.profileEdit", 'uses' => "{$controller_name}@profileEdit"]);
        Route::patch('profile/edit', ['as' => "{$module_name}.profileUpdate", 'uses' => "{$controller_name}@profileUpdate"]);
        Route::get('profile/changePassword', ['as' => "{$module_name}.changePassword", 'uses' => "{$controller_name}@changePassword"]);
        Route::patch('profile/changePassword', ['as' => "{$module_name}.changePasswordUpdate", 'uses' => "{$controller_name}@changePasswordUpdate"]);
        Route::get('profile/{username?}', ['as' => "{$module_name}.profile", 'uses' => "{$controller_name}@profile"]);
        Route::get("{$module_name}/emailConfirmationResend", ['as' => "{$module_name}.emailConfirmationResend", 'uses' => "{$controller_name}@emailConfirmationResend"]);
        Route::delete("{$module_name}/userProviderDestroy", ['as' => "{$module_name}.userProviderDestroy", 'uses' => "{$controller_name}@userProviderDestroy"]);
    });
});

//  ____    _    ____ _  _______ _   _ ____
// | __ )  / \  / ___| |/ / ____| \ | |  _ \
// |  _ \ / _ \| |   | ' /|  _| |  \| | | | |
// | |_) / ___ \ |___| . \| |___| |\  | |_| |
// |____/_/   \_\____|_|\_\_____|_| \_|____/

Route::group(['namespace' => 'App\Http\Controllers\Backend', 'prefix' => 'admin', 'as' => 'backend.', 'middleware' => ['auth', 'can:view_backend']], function () {
    /**
     * Backend Dashboard
     * Namespaces indicate folder structure.
     */
    Route::get('/', 'BackendController@index')->name('home');
    Route::get('dashboard', 'BackendController@index')->name('dashboard');

    /*
     *
     *  Colors Routes
     *
     * ---------------------------------------------------------------------
     */
    Route::controller(ColorController::class)->group(function () {
        Route::get("colors", "index")->name("colors");
        Route::get("colors/create", "create")->name("colors.create");
        Route::post("colors/store", "store")->name("colors.store");
        Route::get("colors/edit/{color}", "edit")->name("colors.edit");
        Route::post("colors/update/{color}", "update")->name("colors.update");
        Route::patch("colors/status", "status")->name("colors.status");
        Route::delete("colors/destroy", "destroy")->name('colors.destroy');
    });
    /*
     *
     *  Sizes Routes
     *
     * ---------------------------------------------------------------------
     */
    Route::controller(SizeController::class)->group(function () {
        Route::get("sizes", "index")->name("sizes");
        Route::get("sizes/create", "create")->name("sizes.create");
        Route::post("sizes/store", "store")->name("sizes.store");
        Route::get("sizes/edit/{color}", "edit")->name("sizes.edit");
        Route::post("sizes/update/{color}", "update")->name("sizes.update");
        Route::patch("sizes/status", "status")->name("sizes.status");
        Route::delete("sizes/destroy", "destroy")->name('sizes.destroy');
    });

    /*
     *
     *  Products Routes
     *
     * ---------------------------------------------------------------------
     */
    Route::controller(ProductController::class)->group(function () {
        Route::get("products", "index")->name("products");
        Route::get("products/create", "create")->name("products.create");
        Route::post("products/store", "store")->name("products.store");
        Route::get("products/edit/{product}", "edit")->name("products.edit");
        Route::post("products/update/{product}", "update")->name("products.update");
        Route::patch("products/status", "status")->name("products.status");
        Route::delete("products/destroy", "destroy")->name('products.destroy');
    });

    /*
     *
     *  Types Routes
     *
     * ---------------------------------------------------------------------
     */
    Route::controller(SizeController::class)->group(function () {
        Route::get("sizes", "index")->name("sizes");
        Route::get("sizes/create", "create")->name("sizes.create");
        Route::post("sizes/store", "store")->name("sizes.store");
        Route::get("sizes/edit/{color}", "edit")->name("sizes.edit");
        Route::post("sizes/update/{color}", "update")->name("sizes.update");
        Route::delete("sizes/destroy", "destroy")->name('sizes.destroy');
    });
    /*
     *
     *  Settings Routes
     *
     * ---------------------------------------------------------------------
     */
    Route::group(['middleware' => ['can:edit_settings']], function () {
        $module_name = 'settings';
        $controller_name = 'SettingController';
        Route::get("{$module_name}", "{$controller_name}@index")->name("{$module_name}");
        Route::post("{$module_name}", "{$controller_name}@store")->name("{$module_name}.store");
    });

    /*
    *
    *  Notification Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'notifications';
    $controller_name = 'NotificationsController';
    Route::get("{$module_name}", ['as' => "{$module_name}.index", 'uses' => "{$controller_name}@index"]);
    Route::get("{$module_name}/markAllAsRead", ['as' => "{$module_name}.markAllAsRead", 'uses' => "{$controller_name}@markAllAsRead"]);
    Route::delete("{$module_name}/deleteAll", ['as' => "{$module_name}.deleteAll", 'uses' => "{$controller_name}@deleteAll"]);
    Route::get("{$module_name}/{id}", ['as' => "{$module_name}.show", 'uses' => "{$controller_name}@show"]);

    /*
    *
    *  Backup Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'backups';
    $controller_name = 'BackupController';
    Route::get("{$module_name}", ['as' => "{$module_name}.index", 'uses' => "{$controller_name}@index"]);
    Route::get("{$module_name}/create", ['as' => "{$module_name}.create", 'uses' => "{$controller_name}@create"]);
    Route::get("{$module_name}/download/{file_name}", ['as' => "{$module_name}.download", 'uses' => "{$controller_name}@download"]);
    Route::get("{$module_name}/delete/{file_name}", ['as' => "{$module_name}.delete", 'uses' => "{$controller_name}@delete"]);

    /*
    *
    *  Roles Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'roles';
    $controller_name = 'RolesController';
    Route::resource("{$module_name}", "{$controller_name}");

    /*
    *
    *  Users Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'users';
    $controller_name = 'UserController';
    Route::get("{$module_name}/{id}/resend-email-confirmation", ['as' => "{$module_name}.emailConfirmationResend", 'uses' => "{$controller_name}@emailConfirmationResend"]);
    Route::delete("{$module_name}/user-provider-destroy", ['as' => "{$module_name}.userProviderDestroy", 'uses' => "{$controller_name}@userProviderDestroy"]);
    Route::get("{$module_name}/{id}/change-password", ['as' => "{$module_name}.changePassword", 'uses' => "{$controller_name}@changePassword"]);
    Route::patch("{$module_name}/{id}/change-password", ['as' => "{$module_name}.changePasswordUpdate", 'uses' => "{$controller_name}@changePasswordUpdate"]);
    Route::get("{$module_name}/trashed", ['as' => "{$module_name}.trashed", 'uses' => "{$controller_name}@trashed"]);
    Route::patch("{$module_name}/{id}/trashed", ['as' => "{$module_name}.restore", 'uses' => "{$controller_name}@restore"]);
    Route::get("{$module_name}/index_data", ['as' => "{$module_name}.index_data", 'uses' => "{$controller_name}@index_data"]);
    Route::get("{$module_name}/index_list", ['as' => "{$module_name}.index_list", 'uses' => "{$controller_name}@index_list"]);
    Route::patch("{$module_name}/{id}/block", ['as' => "{$module_name}.block", 'uses' => "{$controller_name}@block", 'middleware' => ['can:block_users']]);
    Route::patch("{$module_name}/{id}/unblock", ['as' => "{$module_name}.unblock", 'uses' => "{$controller_name}@unblock", 'middleware' => ['can:block_users']]);
    Route::resource("{$module_name}", "{$controller_name}");
});

/**
 * File Manager Routes.
 */
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth', 'can:view_backend']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
