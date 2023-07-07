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
    /**Roles Routes */
    Route::get('{role}/roles', [App\Modules\V1\Roles\Controllers\RoleController::class,'getRoleView'])->name('role.view');
    Route::get('{role}/add-role', [App\Modules\V1\Roles\Controllers\RoleController::class,'addRoleView'])->name('role.add.view');
    Route::post('{role}/add-role', [App\Modules\V1\Roles\Controllers\RoleController::class,'addRoleForm'])->name('role.add.form');
    Route::get('{role}/edit-role', [App\Modules\V1\Roles\Controllers\RoleController::class,'editRoleView'])->name('role.edit.view');
    Route::post('{role}/edit-role', [App\Modules\V1\Roles\Controllers\RoleController::class,'editRoleForm'])->name('role.edit.form');
    Route::get('{role}/delete-role', [App\Modules\V1\Roles\Controllers\RoleController::class,'deleteRole'])->name('role.delete');
    
});