<?php

use App\Http\Controllers\Backend\AjaxController;
use App\Http\Controllers\Backend\Courses\CourseController;
use App\Http\Controllers\Backend\FundController;
use App\Http\Controllers\Backend\MasterFiles\ClinicianTypeController;
use App\Http\Controllers\Backend\MasterFiles\ColorController;
use App\Http\Controllers\Backend\MasterFiles\QualificationTypeController;
use App\Http\Controllers\Backend\MasterFiles\ShiftHourController;
use App\Http\Controllers\Backend\MasterFiles\ShiftTypeController;
use App\Http\Controllers\Backend\MasterFiles\SizeController;
use App\Http\Controllers\Backend\PaymentMethodController;
use App\Http\Controllers\Backend\Products\ProductController;
use App\Http\Controllers\Backend\Select2Controller;
use App\Http\Controllers\Backend\ShiftController;
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

//  ____  _____ _     _____ ____ _____   ____
// / ___|| ____| |   | ____/ ___|_   _| |___ \
// \___ \|  _| | |   |  _|| |     | |     __) |
//  ___) | |___| |___| |__| |___  | |    / __/
// |____/|_____|_____|_____\____| |_|   |_____|
Route::controller(Select2Controller::class)->group(function () {
    Route::get('select2/countries', 'countriesSelect2')->name('countries.select2');
    Route::get('select2/states', 'statesSelect2')->name('states.select2');
    Route::get('select2/cities', 'citiesSelect2')->name('cities.select2');
    Route::get('select2/qualification-types', 'qualificationTypesSelect2')->name('qualification-types.select2');
    Route::get('select2/shift-types', 'shiftTypesSelect2')->name('shift-types.select2');
    Route::get('select2/clinician-types', 'clinicianTypesSelect2')->name('clinician-types.select2');
    Route::get('select2/shift-hours', 'shiftHourSelect2')->name('shift-hours.select2');

});

//  ____        _       _____     _     _
// |  _ \  __ _| |_ __ |_   _|_ _| |__ | | ___
// | | | |/ _` | __/ _` || |/ _` | '_ \| |/ _ \
// | |_| | (_| | || (_| || | (_| | |_) | |  __/
// |____/ \__,_|\__\__,_||_|\__,_|_.__/|_|\___|

Route::get('colors/dataTable', [ColorController::class, 'dataTable'])->name('colors.dataTable');
Route::get('sizes/dataTable', [SizeController::class, 'dataTable'])->name('sizes.dataTable');
Route::get('products/dataTable', [ProductController::class, 'dataTable'])->name('products.dataTable');
Route::get('courses/dataTable', [CourseController::class, 'dataTable'])->name('courses.dataTable');
Route::get('qualification-types/dataTable', [QualificationTypeController::class, 'dataTable'])->name('qualification-types.dataTable');
Route::get('shift-types/dataTable', [ShiftTypeController::class, 'dataTable'])->name('shift-types.dataTable');
Route::get('clinician-types/dataTable', [ClinicianTypeController::class, 'dataTable'])->name('clinician-types.dataTable');
Route::get('payment-methods/dataTable', [PaymentMethodController::class, 'dataTable'])->name('payment-methods.dataTable');
Route::get('funds/dataTable', [FundController::class, 'dataTable'])->name('funds.dataTable');
Route::get('shifts/dataTable', [ShiftController::class, 'dataTable'])->name('shifts.dataTable');
Route::get('shift-hours/dataTable', [ShiftHourController::class, 'dataTable'])->name('shift-hours.dataTable');

//     _     _
//    / \   (_) __ ___  __
//   / _ \  | |/ _` \ \/ /
//  /  ___ \ | | (_| |> <
// /_/   \_\/ |\__,_/_/\_\
//        |__/
Route::controller(ColorController::class)->group(function () {
    Route::get('product/name-unique', 'productNameValidator')->name('product.validator');
});
Route::get('shifts/autocomplete', [AjaxController::class, 'shiftAutocomplete'])->name('shifts.autocomplete');



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

Route::group(['namespace' => 'App\Http\Controllers\Backend', 'prefix' => 'admin', 'as' => 'backend.', 'middleware' => ['auth']], function () {
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
        Route::get("sizes/edit/{size}", "edit")->name("sizes.edit");
        Route::post("sizes/update/{size}", "update")->name("sizes.update");
        Route::patch("sizes/status", "status")->name("sizes.status");
        Route::delete("sizes/destroy", "destroy")->name('sizes.destroy');
    });

    /*
     *
     *  Qualification Types Routes
     *
     * ---------------------------------------------------------------------
     */
    Route::controller(QualificationTypeController::class)->group(function () {
        Route::get("qualification-types", "index")->name("qualification-types");
        Route::get("qualification-types/create", "create")->name("qualification-types.create");
        Route::post("qualification-types/store", "store")->name("qualification-types.store");
        Route::get("qualification-types/edit/{qualification_type}", "edit")->name("qualification-types.edit");
        Route::post("qualification-types/update/{qualification_type}", "update")->name("qualification-types.update");
        Route::patch("qualification-types/status", "status")->name("qualification-types.status");
        Route::delete("qualification-types/destroy", "destroy")->name('qualification-types.destroy');
    });

    /*
     *
     *  Shift Types Routes
     *
     * ---------------------------------------------------------------------
     */
    Route::controller(ShiftTypeController::class)->group(function () {
        Route::get("shift-types", "index")->name("shift-types");
        Route::get("shift-types/create", "create")->name("shift-types.create");
        Route::post("shift-types/store", "store")->name("shift-types.store");
        Route::get("shift-types/edit/{shift_type}", "edit")->name("shift-types.edit");
        Route::post("shift-types/update/{shift_type}", "update")->name("shift-types.update");
        Route::patch("shift-types/status", "status")->name("shift-types.status");
        Route::delete("shift-types/destroy", "destroy")->name('shift-types.destroy');
    });

    /*
     *
     *  Clinician Types Routes
     *
     * ---------------------------------------------------------------------
     */
    Route::controller(ClinicianTypeController::class)->group(function () {
        Route::get("clinician-types", "index")->name("clinician-types");
        Route::get("clinician-types/create", "create")->name("clinician-types.create");
        Route::post("clinician-types/store", "store")->name("clinician-types.store");
        Route::get("clinician-types/edit/{clinician_type}", "edit")->name("clinician-types.edit");
        Route::post("clinician-types/update/{clinician_type}", "update")->name("clinician-types.update");
        Route::patch("clinician-types/status", "status")->name("clinician-types.status");
        Route::delete("clinician-types/destroy", "destroy")->name('clinician-types.destroy');
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
     *  Courses Routes
     *
     * ---------------------------------------------------------------------
     */
    Route::controller(CourseController::class)->group(function () {
        Route::get("courses", "index")->name("courses");
        Route::get("courses/create", "create")->name("courses.create");
        Route::post("courses/store", "store")->name("courses.store");
        Route::get("courses/edit/{course}", "edit")->name("courses.edit");
        Route::post("courses/update/{course}", "update")->name("courses.update");
        Route::patch("courses/status", "status")->name("courses.status");
        Route::delete("courses/destroy", "destroy")->name('courses.destroy');
    });

    /*
     *
     *  Payment Methods Routes
     *
     * ---------------------------------------------------------------------
     */
    Route::controller(PaymentMethodController::class)->group(function () {
        Route::get("payment-methods", "index")->name("payment-methods");
        Route::get("payment-methods/create", "create")->name("payment-methods.create");
        Route::post("payment-methods/store", "store")->name("payment-methods.store");
        Route::get("payment-methods/edit/{payment_method}", "edit")->name("payment-methods.edit");
        Route::post("payment-methods/update/{payment_method}", "update")->name("payment-methods.update");
        Route::patch("payment-methods/status", "status")->name("payment-methods.status");
        Route::delete("payment-methods/destroy", "destroy")->name('payment-methods.destroy');
    });

    /*
     *
     *  Funds Routes
     *
     * ---------------------------------------------------------------------
     */
    Route::controller(FundController::class)->group(function () {
        Route::get("funds", "index")->name("funds");
        Route::get("funds/create", "create")->name("funds.create");
        Route::post("funds/store", "store")->name("funds.store");
        Route::get("funds/edit/{fund}", "edit")->name("funds.edit");
        Route::post("funds/update/{fund}", "update")->name("funds.update");
        Route::patch("funds/status", "status")->name("funds.status");
        Route::delete("funds/destroy", "destroy")->name('funds.destroy');
    });

    /*
     *
     *  Shifts Routes
     *
     * ---------------------------------------------------------------------
     */
    Route::controller(ShiftController::class)->group(function () {
        Route::get("shifts", "index")->name("shifts");
        Route::get("shifts/create", "create")->name("shifts.create");
        Route::post("shifts/store", "store")->name("shifts.store");
        Route::get("shifts/edit/{shift}", "edit")->name("shifts.edit");
        Route::post("shifts/update/{shift}", "update")->name("shifts.update");
        Route::patch("shifts/status", "status")->name("shifts.status");
        Route::delete("shifts/destroy", "destroy")->name('shifts.destroy');
    });

    /*
     *
     *  Shift Hour Routes
     *
     * ---------------------------------------------------------------------
     */
    Route::controller(ShiftHourController::class)->group(function () {
        Route::get("shift-hours", "index")->name("shift-hours");
        Route::get("shift-hours/create", "create")->name("shift-hours.create");
        Route::post("shift-hours/store", "store")->name("shift-hours.store");
        Route::get("shift-hours/edit/{shift_hour}", "edit")->name("shift-hours.edit");
        Route::post("shift-hours/update/{shift_hour}", "update")->name("shift-hours.update");
        Route::patch("shift-hours/status", "status")->name("shift-hours.status");
        Route::delete("shift-hours/destroy", "destroy")->name('shift-hours.destroy');
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
