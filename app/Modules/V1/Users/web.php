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
Route::group(['middleware' => ['web','auth']], function(){ 
  
    /**User Routes */
    Route::get('{role}/users', [App\Modules\V1\Users\Controllers\UserController::class,'getUserView'])->name('users.view');
    Route::get('{role}/add-users', [App\Modules\V1\Users\Controllers\UserController::class,'addUserView'])->name('user.add.view');
    Route::post('{role}/add-users', [App\Modules\V1\Users\Controllers\UserController::class,'addUserForm'])->name('user.add.form');
    Route::get('{role}/edit-users', [App\Modules\V1\Users\Controllers\UserController::class,'editUserView'])->name('user.edit.view');
    Route::post('{role}/edit-users', [App\Modules\V1\Users\Controllers\UserController::class,'editUserForm'])->name('user.edit.form');
    Route::get('{role}/delete-users', [App\Modules\V1\Users\Controllers\UserController::class,'deleteUser'])->name('user.delete');
    

});