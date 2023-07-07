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
    /**seo Routes */
    Route::get('{role}/seo', [App\Modules\V1\Seo\Controllers\SeoController::class,'view'])->name('seo.view');   
    Route::get('{role}/add-seo', [App\Modules\V1\Seo\Controllers\SeoController::class,'addView'])->name('seo.add.view');
    Route::post('{role}/add-seo', [App\Modules\V1\Seo\Controllers\SeoController::class,'store'])->name('seo.add.form');
    Route::get('{role}/edit-seo', [App\Modules\V1\Seo\Controllers\SeoController::class,'editView'])->name('seo.edit.view');
    Route::post('{role}/edit-seo', [App\Modules\V1\Seo\Controllers\SeoController::class,'update'])->name('seo.edit.form'); 
    Route::get('{role}/delete-seo', [App\Modules\V1\Seo\Controllers\SeoController::class,'delete'])->name('seo.delete.form');
});