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
    /**Pages Routes */
    Route::get('{role}/pages', [App\Modules\V1\Pages\Controllers\PageController::class,'view'])->name('pages.view');   
    Route::get('{role}/add-pages', [App\Modules\V1\Pages\Controllers\PageController::class,'addView'])->name('pages.add.view');
    Route::post('{role}/add-pages', [App\Modules\V1\Pages\Controllers\PageController::class,'store'])->name('pages.add.form');
    Route::get('{role}/edit-pages', [App\Modules\V1\Pages\Controllers\PageController::class,'editView'])->name('pages.edit.view');
    Route::post('{role}/edit-pages', [App\Modules\V1\Pages\Controllers\PageController::class,'update'])->name('pages.edit.form'); 
    Route::get('{role}/delete-page', [App\Modules\V1\Pages\Controllers\PageController::class,'delete'])->name('page.delete.form');
});