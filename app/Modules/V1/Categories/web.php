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

    /**Category Routes */
    Route::get('{role}/category', [App\Modules\V1\Categories\Controllers\CategoryController::class,'getCategoryView'])->name('category.view');
    Route::get('{role}/add-category/', [App\Modules\V1\Categories\Controllers\CategoryController::class,'getAddCategoryView'])->name('category.add.view');
    Route::post('{role}/add-category/', [App\Modules\V1\Categories\Controllers\CategoryController::class,'getAddCategoryForm'])->name('category.add.form');
    Route::get('{role}/edit-category', [App\Modules\V1\Categories\Controllers\CategoryController::class,'getEditCategoryView'])->name('category.edit.view');
    Route::post('{role}/edit-category', [App\Modules\V1\Categories\Controllers\CategoryController::class,'getEditCategoryForm'])->name('category.edit.form');
    Route::get('{role}/delete-category', [App\Modules\V1\Categories\Controllers\CategoryController::class,'getdeleteCategoryForm'])->name('category.delete.form');

});