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
  
    /**Product Routes */
    Route::get('{role}/product', [App\Modules\V1\Product\Controllers\ProductController::class,'view'])->name('product.view');   
    Route::get('{role}/add-product', [App\Modules\V1\Product\Controllers\ProductController::class,'addView'])->name('product.add.view');
    
    
    // Variable Product Routes 
    Route::get('{role}/add-variable-product', [App\Modules\V1\Product\Controllers\ProductController::class,'addVariableView'])->name('product.add.variable.view');
    Route::post('{role}/add-variable-product', [App\Modules\V1\Product\Controllers\ProductController::class,'addVariableForm'])->name('product.add.variable.form');
    Route::get('{role}/add-variable-product-feature-value/', [App\Modules\V1\Product\Controllers\ProductController::class,'addVariableFeatureValueView'])->name('product.add.variable.feature-value.view');
    Route::post('{role}/add-variable-product-feature-value/', [App\Modules\V1\Product\Controllers\ProductController::class,'addVariableFeatureValueForm'])->name('product.add.variable.feature-value.form');


    Route::post('{role}/add-product', [App\Modules\V1\Product\Controllers\ProductController::class,'store'])->name('product.add.form');
    Route::get('{role}/edit-product', [App\Modules\V1\Product\Controllers\ProductController::class,'editView'])->name('product.edit.view');
    Route::post('{role}/edit-product', [App\Modules\V1\Product\Controllers\ProductController::class,'update'])->name('product.edit.form'); 
    Route::get('{role}/delete-product', [App\Modules\V1\Product\Controllers\ProductController::class,'delete'])->name('product.delete.form');

    /**Product Data Routes */
    Route::post('{role}/get-sub-category-product', [App\Modules\V1\Product\Controllers\ProductController::class,'getSubCategories'])->name('product.get.category.data');
    Route::post('{role}/get-feature-product', [App\Modules\V1\Product\Controllers\ProductController::class,'getFeature'])->name('product.get.feature.data');

});