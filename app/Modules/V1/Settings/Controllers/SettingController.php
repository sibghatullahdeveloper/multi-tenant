<?php


namespace App\Modules\V1\Settings\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\V1\Settings\Models\CurrencyConversion;
use App\Modules\V1\Settings\Services\SettingServices;
use App\Modules\V1\Users\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class SettingController extends Controller
{
    protected $settingServices;
    protected $userServices;

    public function __construct(SettingServices $settingService,UserService $userService) {
        $this->settingServices = $settingService;
        $this->userServices = $userService;
    }
    

    public function getSettingView(Request $request)
    {
        return view('Settings::settings.index',[
            'sidebar' => $this->userServices->getSideBar(),
             
            'active_permissions' => $this->userServices->getPermissionsFromRole('users'),
            'message' => '',
        ]);
    }

    /**
     * 
     * Setting Accounts 
     * 
     */

    public function getAccountsView(Request $request)
    {
        $keys = $this->settingServices->getTimmingKeys();
        array_push($keys,'business_name','business_phone_number','business_whatsapp_number','contact_email','business_location','business_address');
        return view('Settings::settings.accounts_setting',[
            'sidebar' => $this->userServices->getSideBar(),
            'active_permissions' => $this->userServices->getPermissionsFromRole('settings'),
            'message' => '',
            'timings' => config('timings'),
            'account_setting' => $this->settingServices->getDecryptValue($keys),
        ]);
    }

    public function getAccountsForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'business_name' => 'required',
            'business_phone_number' => 'required',
            'business_whatsapp_number' => 'required',
            'contact_email' => 'required',
            'business_location' => 'required',
            'business_address' => 'required',
        ]);
        
        if($validator->fails()) {
            return redirect()->back()->with('error',$validator->messages());
        }else{
           $check = $this->settingServices->insertAccountForm($request);
           if($check){
               /**Get Values keys */
            $keys = $this->settingServices->getTimmingKeys();
            array_push($keys,'business_name','business_phone_number','business_whatsapp_number','contact_email','business_location','business_address');

            return Redirect::route('setting.accounts.view',[
                'role'=> \Auth::user()->role->slug,                   
            ])->with([
                'sidebar' => $this->userServices->getSideBar(),
                'active_permissions' => $this->userServices->getPermissionsFromRole('roles'),
                'message' => 'Account Settings Updated Successfully',
                'timings' => config('timings'),
                'account_setting' => $this->settingServices->getDecryptValue($keys),
            ]);
           }else{
                return redirect()->back()->with('error',['something went wrong']);
           }
        } 
    }

    /**
     * 
     * Setting Currency 
     * 
     */

    public function getCurrencyRateView(Request $request)
    {   
        return view('Settings::settings.currency_rate',[
            'sidebar' => $this->userServices->getSideBar(),
            'active_permissions' => $this->userServices->getPermissionsFromRole('settings'),
            'message' => '',
            'default_currency' => $this->settingServices->getDefaultCurrency(),
            'currencies' => $this->settingServices->getCurrencies(),
            'conversion_rate' => $this->settingServices->getCurrenciesConvertionWithRelationship()
        ]);
    }

    public function setDefaultCurrency(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'currency' => 'required',
        ]);
        
        if($validator->fails()) {
            return redirect()->back()->with('error',$validator->messages());
        }else{
            $this->settingServices->setDefaultCurrency($request->currency);
            return Redirect::route('setting.currency.rate.view',[
                'role'=> \Auth::user()->role->slug,                   
            ])->with([
                'sidebar' => $this->userServices->getSideBar(),
                'active_permissions' => $this->userServices->getPermissionsFromRole('settings'),
                'message' => 'Currency Setup Successfully Successfully',
                'default_currency' => $this->settingServices->getDefaultCurrency(),
                'currencies' => $this->settingServices->getCurrencies(),
                'conversion_rate' => $this->settingServices->getCurrenciesConvertionWithRelationship()
            ]);
        }
    }

    public function getCurrencyRate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'source_currency' => 'required',
        ]);

        if($validator->fails()) {
            return sendError('Please Select Target Currency');
        }else{
            return $this->settingServices->getConversionRateAjax($request->source_currency);
        }
    }

    public function getCurrencyRateForm(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'source_currency' => 'required',
            'target_currency' => 'required',
            'closing_rate' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->with('error',$validator->messages());
        }else{
            $check = $this->settingServices->addConversionRate($request->all());
            if($check){
                return Redirect::route('setting.currency.rate.view',[
                    'role'=> \Auth::user()->role->slug,                   
                ])->with([
                    'sidebar' => $this->userServices->getSideBar(),
                    'active_permissions' => $this->userServices->getPermissionsFromRole('settings'),
                    'message' => 'Rate Changed Successfully',
                    'default_currency' => $this->settingServices->getDefaultCurrency(),
                    'currencies' => $this->settingServices->getCurrencies(),
                    'conversion_rate' => $this->settingServices->getCurrenciesConvertionWithRelationship()
                ]);
            }
        }
        dd($request->all());
    }
   
    public function getSocialPagesView(Request $request)
    {
        return view('Settings::settings.social_pages',[
            'sidebar' => $this->userServices->getSideBar(),
             
            'active_permissions' => $this->userServices->getPermissionsFromRole('settings'),
            'message' => '',
        ]);
    }

   



    /**
     * 
     * 
     * Email Setting 
     *
     *   
     */


    public function getEmailSettingsView(Request $request)
    {
        return view('Settings::settings.email_setting',[
            'sidebar' => $this->userServices->getSideBar(),
             
            'active_permissions' => $this->userServices->getPermissionsFromRole('settings'),
            'message' => '',
            'data' => $this->settingServices->getDecryptValue(['sender_name','reply_to_address'])
        ]);
    }

    public function getEmailSettingsForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sender_name' => 'required',
            'reply_to_address' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->with('error',$validator->messages());
        }else{
            $this->settingServices->updateSettingValue([
                "SENDER_NAME" => $request->sender_name,
                "REPLY_TO_ADDRESS" => $request->reply_to_address,
            ]);

            return Redirect::route('setting.email.view',[
                'role'=> \Auth::user()->role->slug,                   
            ])->with([
                'sidebar' => $this->userServices->getSideBar(),
                 
                'active_permissions' => $this->userServices->getPermissionsFromRole('settings'),
                'message' => '',
                'data' => $this->settingServices->getDecryptValue(['sender_name','reply_to_address'])
            ]); 
        }
    }


    /**
     * 
     * 
     * Mobile Application Links
     * 
     * 
     */
    

    public function getApplicationLinkView(Request $request)
    {
        return view('Settings::settings.mobile_app_links',[
            'sidebar' => $this->userServices->getSideBar(),
             
            'active_permissions' => $this->userServices->getPermissionsFromRole('settings'),
            'message' => '',
            'data' => $this->settingServices->getDecryptValue(['ANDROID_APP_LINK','IOS_APP_LINK'],true)
        ]);
    }


     public function getApplicationLinkForm(Request $request)
     {
        $validator = Validator::make($request->all(), [
            'android_link' => 'required',
            'ios_link' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->with('error',$validator->messages());
        }else{
            $this->settingServices->updateSettingValue([
                "ANDROID_APP_LINK" => $request->android_link,
                "IOS_APP_LINK" => $request->ios_link,
            ]);

            return Redirect::route('setting.application.links.view',[
                'role'=> \Auth::user()->role->slug,                   
            ])->with([
                'sidebar' => $this->userServices->getSideBar(),
                 
                'active_permissions' => $this->userServices->getPermissionsFromRole('settings'),
                'message' => '',
                'data' => $this->settingServices->getDecryptValue(['ANDROID_APP_LINK','IOS_APP_LINK'],true)
            ]); 
        }
     }


     /**
      * 
      * Order Settings
      *
      */


    public function getOrderSettingView(Request $request)
    {
        return view('Settings::settings.order_credentials',[
            'sidebar' => $this->userServices->getSideBar(),
             
            'active_permissions' => $this->userServices->getPermissionsFromRole('settings'),
            'message' => '',
            'data' => $this->settingServices->getDecryptValue(['MINIMUM_ORDER_AMOUNT','MINIMUM_ORDER_AMOUNT_FREE_DELIVERY','PAYMENT_METHOD_CASH_ON_DELIVERY','PAYMENT_METHOD_PAYPAL','PAYMENT_METHOD_STRIPE'],true)
        ]);
    }


    public function getOrderSettingForm(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'minimum_order_amount' => 'required',
            'minimum_order_amount_free_delivery' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->with('error',$validator->messages());
        }else{
            $this->settingServices->updateSettingValue([
                "minimum_order_amount" => $request->minimum_order_amount,
                "minimum_order_amount_free_delivery" => $request->minimum_order_amount_free_delivery,
            ]);

            if($request->payment_method_cash_on_delivery == 'on'){
                $this->settingServices->updateSettingValue([
                    "payment_method_cash_on_delivery" => $request->payment_method_cash_on_delivery,
                ]);
            }else{
                $this->settingServices->updateSettingValue([
                    "payment_method_cash_on_delivery" => '',
                ]);
            }

            if($request->payment_method_paypal == 'on'){
                $this->settingServices->updateSettingValue([
                    "payment_method_paypal" => $request->payment_method_paypal,
                ]);
            }else{
                $this->settingServices->updateSettingValue([
                    "payment_method_paypal" => '',
                ]);
            }

            if($request->payment_method_stripe == 'on'){
                $this->settingServices->updateSettingValue([
                    "payment_method_stripe" => $request->payment_method_stripe,
                ]);
            }else{
                $this->settingServices->updateSettingValue([
                    "payment_method_stripe" => '',
                ]);
            }

            return Redirect::route('setting.order.view',[
                'role'=> \Auth::user()->role->slug,                   
            ])->with([
                'sidebar' => $this->userServices->getSideBar(),
                 
                'active_permissions' => $this->userServices->getPermissionsFromRole('settings'),
                'message' => '',
                'data' => $this->settingServices->getDecryptValue(['MINIMUM_ORDER_AMOUNT','MINIMUM_ORDER_AMOUNT_FREE_DELIVERY','PAYMENT_METHOD_CASH_ON_DELIVERY','PAYMENT_METHOD_PAYPAL','PAYMENT_METHOD_STRIPE'],true)
            ]); 
        }
    }


    /**
     * 
     * SMTP Settings
     * 
     */

    public function getSmtpCredentialsView(Request $request)
    {
        return view('Settings::settings.smtp_credentials',[
            'sidebar' => $this->userServices->getSideBar(),
             
            'active_permissions' => $this->userServices->getPermissionsFromRole('settings'),
            'message' => '',
            'data' => $this->settingServices->getDecryptValue(['SMTP_USERNAME','SMTP_PASSWORD','SMTP_HOST','SMTP_PORT'],true)
        ]);
    }

    public function getSmtpCredentialsForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'smtp_username' => 'required',
            'smtp_password' => 'required',
            'smtp_host' => 'required',
            'smtp_port' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->with('error',$validator->messages());
        }else{
            $this->settingServices->updateSettingValue([
                "SMTP_USERNAME" => $request->smtp_username,
                "SMTP_PASSWORD" => $request->smtp_password,
                'SMTP_HOST' => $request->smtp_host,
                'SMTP_PORT' => $request->smtp_port,
            ]);

            return Redirect::route('setting.smtp.credentials.view',[
                'role'=> \Auth::user()->role->slug,                   
            ])->with([
                'sidebar' => $this->userServices->getSideBar(),
                 
                'active_permissions' => $this->userServices->getPermissionsFromRole('settings'),
                'message' => '',
                'data' => $this->settingServices->getDecryptValue(['SMTP_USERNAME','SMTP_PASSWORD','SMTP_HOST','SMTP_PORT'],true)
            ]); 
        }
    }

    /**
     * 
     * Social Links
     * 
     */

    public function getSocialLinksView(Request $request)
    {
        return view('Settings::settings.social_links',[
            'sidebar' => $this->userServices->getSideBar(),
             
            'active_permissions' => $this->userServices->getPermissionsFromRole('users'),
            'message' => '',
            'data' => $this->settingServices->getDecryptValue([
                "SOCIAL_FACEBOOK",
                "SOCIAL_INSTAGRAM",
                'SOCIAL_LINKEDIN',
                'SOCIAL_TWITTER',
                "SOCIAL_SNAPCHAT",
                "SOCIAL_WHATSAPP",
                'SOCIAL_YOUTUBE',
                'SOCIAL_GOOGLE_BUSSINESS',
                'SOCIAL_GITHUB',
            ],true)
        ]);
    }

    public function getSocialLinksForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'social_facebook' => 'required',
            // 'social_instagram' => 'required',
            // 'social_linkedin' => 'required',
            // 'social_twitter' => 'required',
            // 'social_snapchat' => 'required',
            // 'social_whatsapp' => 'required',
            // 'social_youtube' => 'required',
            // 'social_google_business' => 'required',
            // 'social_github' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->with('error',$validator->messages());
        }else{
            $this->settingServices->updateSettingValue([
                "SOCIAL_FACEBOOK" => $request->social_facebook,
                "SOCIAL_INSTAGRAM" => $request->social_instagram,
                'SOCIAL_LINKEDIN' => $request->social_linkedin,
                'SOCIAL_TWITTER' => $request->social_twitter,
                "SOCIAL_SNAPCHAT" => $request->social_snapchat,
                "SOCIAL_WHATSAPP" => $request->social_whatsapp,
                'SOCIAL_YOUTUBE' => $request->social_youtube,
                'SOCIAL_GOOGLE_BUSSINESS' => $request->social_google_business,
                'SOCIAL_GITHUB' => $request->social_github,
            ]);

            return Redirect::route('setting.social.links.view',[
                'role'=> \Auth::user()->role->slug,                   
            ])->with([
                'sidebar' => $this->userServices->getSideBar(),
                 
                'active_permissions' => $this->userServices->getPermissionsFromRole('settings'),
                'message' => '',
                'data' => $this->settingServices->getDecryptValue([
                    "SOCIAL_FACEBOOK",
                    "SOCIAL_INSTAGRAM",
                    'SOCIAL_LINKEDIN',
                    'SOCIAL_TWITTER',
                    "SOCIAL_SNAPCHAT",
                    "SOCIAL_WHATSAPP",
                    'SOCIAL_YOUTUBE',
                    'SOCIAL_GOOGLE_BUSSINESS',
                    'SOCIAL_GITHUB',
                ],true)
            ]); 
        }
    }

    /**
     * 
     *  Tax Vat Links
     * 
     */

    public function getTaxVatView(Request $request)
    {
        
        return view('Settings::settings.tax_vat_setting',[
            'sidebar' => $this->userServices->getSideBar(),
            'active_permissions' => $this->userServices->getPermissionsFromRole('settings'),
            'message' => '',
            'data' => $this->settingServices->getDecryptValue(['TAX','VAT'],true)
        ]);
    }


    public function getTaxVatForm(Request $request)
    { 
        $validator = Validator::make($request->all(), [
            'tax' => 'required',
            'vat' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->with('error',$validator->messages());
        }else{
            $this->settingServices->updateSettingValue([
                "TAX" => $request->tax,
                "VAT" => $request->vat,
            ]);
        
            return Redirect::route('setting.tax.vat.view',[
                'role'=> \Auth::user()->role->slug,                   
            ])->with([
                'sidebar' => $this->userServices->getSideBar(),
                'active_permissions' => $this->userServices->getPermissionsFromRole('settings'),
                'message' => '',
                'data' => $this->settingServices->getDecryptValue(['TAX','VAT'],true)
            ]); 
        }
    }

    /**
     * 
     * Paypal 
     * 
     */



    public function getPaypalCredentialsView(Request $request)
    {
        return view('Settings::settings.paypal_credentials',[
            'sidebar' => $this->userServices->getSideBar(),
            'active_permissions' => $this->userServices->getPermissionsFromRole('settings'),
            'message' => '',
            'data' => $this->settingServices->getDecryptValue(['PAYPAL_MODE','PAYPAL_API_CLIENT_ID','PAYPAL_API_SECRET'],true)
        ]); 
    }




    public function getPaypalCredentialsForm(Request $request)
    {
        // return $request->all();
       $validator = Validator::make($request->all(), [
        'paypal_mode' => 'required',
        'paypal_api_client_id' => 'required',
        'paypal_api_client_secret' => 'required'
    ]);

        if($validator->fails()) {
            return redirect()->back()->with('error',$validator->messages());
        }else{
            $this->settingServices->updateSettingValue([
                'PAYPAL_MODE' => $request->paypal_mode,
                "PAYPAL_API_CLIENT_ID" => $request->paypal_api_client_id,
                "PAYPAL_API_SECRET" => $request->paypal_api_client_secret,
            ]);
        
            return Redirect::route('setting.paypal.credentials.view',[
                'role'=> \Auth::user()->role->slug,                   
            ])->with([
                'sidebar' => $this->userServices->getSideBar(),
                'active_permissions' => $this->userServices->getPermissionsFromRole('settings'),
                'message' => '',
                'data' => $this->settingServices->getDecryptValue(['PAYPAL_MODE','PAYPAL_API_CLIENT_ID','PAYPAL_API_SECRET'],true)
            ]); 
        }
    }

    public function getSocialLoginView(Request $request)
    {
        return view('Settings::settings.social_login',[
            'sidebar' => $this->userServices->getSideBar(),
            'active_permissions' => $this->userServices->getPermissionsFromRole('settings'),
            'message' => '',
            'data' => $this->settingServices->getDecryptValue(['FACEBOOK_APP_ID','GOOGLE_APP_ID','APPLE_APP_ID','TWITTER_APP_ID'],true)
        ]); 
    }


    public function getSocialLoginForm(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'facebook_app_id' => 'required',
            'google_app_id' => 'required',
            'twitter_app_id' => 'required',
            'apple_app_id' => 'required',
        ]);
    
            if($validator->fails()) {
                return redirect()->back()->with('error',$validator->messages());
            }else{
                $this->settingServices->updateSettingValue([
                    'FACEBOOK_APP_ID' => $request->facebook_app_id,
                    "GOOGLE_APP_ID" => $request->google_app_id,
                    "APPLE_APP_ID" => $request->apple_app_id,
                    'TWITTER_APP_ID' => $request->twitter_app_id,
                ]);
            
                return Redirect::route('setting.social.login.view',[
                    'role'=> \Auth::user()->role->slug,                   
                ])->with([
                    'sidebar' => $this->userServices->getSideBar(),
                    'active_permissions' => $this->userServices->getPermissionsFromRole('settings'),
                    'message' => '',
                    'data' => $this->settingServices->getDecryptValue(['FACEBOOK_APP_ID','GOOGLE_APP_ID','APPLE_APP_ID','TWITTER_APP_ID'],true)
                ]); 
            }
    }

    
}
