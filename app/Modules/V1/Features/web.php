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

    /**Feature Routes */
    Route::get('{role}/features', [App\Modules\V1\Features\Controllers\FeatureController::class,'view'])->name('features.view');   
    Route::get('{role}/add-features', [App\Modules\V1\Features\Controllers\FeatureController::class,'addView'])->name('features.add.view');
    Route::post('{role}/add-features', [App\Modules\V1\Features\Controllers\FeatureController::class,'store'])->name('features.add.form');
    Route::get('{role}/edit-features', [App\Modules\V1\Features\Controllers\FeatureController::class,'editView'])->name('features.edit.view');
    Route::post('{role}/edit-features', [App\Modules\V1\Features\Controllers\FeatureController::class,'update'])->name('features.edit.form'); 
    Route::get('{role}/delete-features', [App\Modules\V1\Features\Controllers\FeatureController::class,'delete'])->name('features.delete.form');


    /**Feature Values Routes */
    Route::get('{role}/feature-value', [App\Modules\V1\Features\Controllers\FeatureValueController::class,'view'])->name('feature-value.view');   
    Route::get('{role}/add-feature-value', [App\Modules\V1\Features\Controllers\FeatureValueController::class,'addView'])->name('feature-value.add.view');
    Route::post('{role}/add-feature-value', [App\Modules\V1\Features\Controllers\FeatureValueController::class,'store'])->name('feature-value.add.form');
    Route::get('{role}/edit-feature-value', [App\Modules\V1\Features\Controllers\FeatureValueController::class,'editView'])->name('feature-value.edit.view');
    Route::post('{role}/edit-feature-value', [App\Modules\V1\Features\Controllers\FeatureValueController::class,'update'])->name('feature-value.edit.form'); 
    Route::get('{role}/delete-feature-value', [App\Modules\V1\Features\Controllers\FeatureValueController::class,'delete'])->name('feature-value.delete.form');
});