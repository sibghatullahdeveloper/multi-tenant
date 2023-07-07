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
    Route::get('{role}/settings', [App\Modules\V1\Settings\Controllers\SettingController::class,'getSettingView'])->name('setting.view');

    /**Accounts Routes */
    Route::get('{role}/accounts', [App\Modules\V1\Settings\Controllers\SettingController::class,'getAccountsView'])->name('setting.accounts.view');
    Route::post('{role}/accounts', [App\Modules\V1\Settings\Controllers\SettingController::class,'getAccountsForm'])->name('setting.accounts.form');
    
    /**Currency Routes */
    Route::get('{role}/currency-rate', [App\Modules\V1\Settings\Controllers\SettingController::class,'getCurrencyRateView'])->name('setting.currency.rate.view');
    Route::post('{role}/currency-rate', [App\Modules\V1\Settings\Controllers\SettingController::class,'getCurrencyRateForm'])->name('setting.currency.rate.form');
    Route::get('{role}/set-default-currency', [App\Modules\V1\Settings\Controllers\SettingController::class,'setDefaultCurrency'])->name('setting.currency.default');
    Route::get('setting/get-currency-rate-ajax', [App\Modules\V1\Settings\Controllers\SettingController::class,'getCurrencyRate'])->name('setting.get.currency.rate.ajax');
    
    /**Email Setting */
    Route::get('{role}/email-settings', [App\Modules\V1\Settings\Controllers\SettingController::class,'getEmailSettingsView'])->name('setting.email.view');
    Route::post('{role}/email-settings', [App\Modules\V1\Settings\Controllers\SettingController::class,'getEmailSettingsForm'])->name('setting.email.form');
    
    /**Mobile Application Settings */
    Route::get('{role}/application-links', [App\Modules\V1\Settings\Controllers\SettingController::class,'getApplicationLinkView'])->name('setting.application.links.view');
    Route::post('{role}/application-links', [App\Modules\V1\Settings\Controllers\SettingController::class,'getApplicationLinkForm'])->name('setting.application.links.form');
    
    /**Order Settings */
    Route::get('{role}/order-settings', [App\Modules\V1\Settings\Controllers\SettingController::class,'getOrderSettingView'])->name('setting.order.view');
    Route::post('{role}/order-settings', [App\Modules\V1\Settings\Controllers\SettingController::class,'getOrderSettingForm'])->name('setting.order.form');
    
    /**SMTP Settings */
    Route::get('{role}/smtp-credentials', [App\Modules\V1\Settings\Controllers\SettingController::class,'getSmtpCredentialsView'])->name('setting.smtp.credentials.view');
    Route::post('{role}/smtp-credentials', [App\Modules\V1\Settings\Controllers\SettingController::class,'getSmtpCredentialsForm'])->name('setting.smtp.credentials.form');
    
    /**Social Links */
    Route::get('{role}/social-links', [App\Modules\V1\Settings\Controllers\SettingController::class,'getSocialLinksView'])->name('setting.social.links.view');
    Route::post('{role}/social-links', [App\Modules\V1\Settings\Controllers\SettingController::class,'getSocialLinksForm'])->name('setting.social.links.form');
    
    /** Tax Vat Links */
    Route::get('{role}/tax-vat', [App\Modules\V1\Settings\Controllers\SettingController::class,'getTaxVatView'])->name('setting.tax.vat.view');
    Route::post('{role}/tax-vat', [App\Modules\V1\Settings\Controllers\SettingController::class,'getTaxVatForm'])->name('setting.tax.vat.form');
    
    /** Paypal Routes */
    Route::get('{role}/paypal', [App\Modules\V1\Settings\Controllers\SettingController::class,'getPaypalCredentialsView'])->name('setting.paypal.credentials.view');
    Route::post('{role}/paypal', [App\Modules\V1\Settings\Controllers\SettingController::class,'getPaypalCredentialsForm'])->name('setting.paypal.credentials.form');
    

    /**Social Logins */
    Route::get('{role}/social-logins', [App\Modules\V1\Settings\Controllers\SettingController::class,'getSocialLoginView'])->name('setting.social.login.view');
    Route::post('{role}/social-logins', [App\Modules\V1\Settings\Controllers\SettingController::class,'getSocialLoginForm'])->name('setting.social.login.form');
    
});