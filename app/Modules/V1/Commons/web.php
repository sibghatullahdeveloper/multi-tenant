<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Modules\V1\Commons\Controllers\AuthController::class,'getLoginView'])->middleware('web')->name('admin.login.view');
Route::post('/login', [App\Modules\V1\Commons\Controllers\AuthController::class,'postLogin'])->middleware('web')->name('admin.login.check');
Route::get('/forgot-password', [App\Modules\V1\Commons\Controllers\AuthController::class,'forgotPasswordView'])->middleware('web')->name('admin.forgot.password');
Route::get('/send-email', [App\Modules\V1\Commons\Controllers\AuthController::class,'sendEmailCode'])->middleware('web')->name('admin.send.code');
Route::get('/verify-code/{email}', [App\Modules\V1\Commons\Controllers\AuthController::class,'verifyCodeView'])->middleware('web')->name('admin.verify.code.view');
Route::post('/verify-code/{email}', [App\Modules\V1\Commons\Controllers\AuthController::class,'verifyCodeForm'])->middleware('web')->name('admin.verify.code.form');


Route::group(['middleware' => ['web','auth']], function(){
     /**Auth Routes Edit Profile */
     Route::get('{role}/edit-profile', [App\Modules\V1\Commons\Controllers\AuthController::class,'editProfileView'])->middleware('web')->name('edit.profile.view');
     Route::post('{role}/edit-profile', [App\Modules\V1\Commons\Controllers\AuthController::class,'editProfileForm'])->middleware('web')->name('edit.profile.form');
     Route::post('{role}/edit-password', [App\Modules\V1\Commons\Controllers\AuthController::class,'editProfilePasswordForm'])->middleware('web')->name('edit.profile.password.form');
    /**Dashboard Routes */
    Route::get('{role}/dashboard', [App\Modules\V1\Commons\Controllers\DashboardController::class,'getDashboardView'])->name('dashboard.view');

     /**Logout */
     Route::get('{role}/logout', [App\Modules\V1\Commons\Controllers\AuthController::class,'logOut'])->name('user.logout');
});
