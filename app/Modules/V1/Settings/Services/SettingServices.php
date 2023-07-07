<?php

namespace App\Modules\V1\Settings\Services;

use App\Modules\V1\Settings\Models\Currency;
use App\Modules\V1\Settings\Models\CurrencyConversion;
use App\Modules\V1\Settings\Models\Setting;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class SettingServices
{
   function insertAccountForm(Request $request)
    {
        $request->request->remove('_token');
        foreach ($request->all() as $key => $value) {
            $this->updateSettingField(strtoupper($key),$value,true);
        }
        return true;
    }

    function updateSettingField($key,$value,$is_value_encrypted = false)
    {
        
        if($is_value_encrypted == false){
            Setting::where('s_key',$key)->update([
                's_value' => $value
            ]);
        }else{
            Setting::where('s_key',$key)->update([
                's_value' => Crypt::encryptString($value)
            ]);
        }
    }

    function getDecryptValue($keys = [],$is_upper_case = false,$is_return_encrypted=false)
    {
        if(is_array($keys)){
            $temp = [];
            foreach ($keys as $key => $value) {
                if($is_upper_case == false){
                    $key_u = strtoupper($value);
                }else{
                    $key_u = strtoupper($value);
                }
                $setting = Setting::where('s_key',$key_u)->first();
                if($is_return_encrypted == false){
                    if($setting->s_value != ""){
                        $temp[$value] = Crypt::decryptString($setting->s_value);
                    }else{
                        $temp[$value] = "";
                    }
                }else{
                    $temp[$value] = $setting->s_value;
                }
                
            }
            return $temp;
        }else{
            $temp = Setting::where('s_key',$keys)->first();
            if($temp->s_value == ""){
                return "";
            }else{
                return Crypt::decryptString($temp->s_value);
            }
        }
    }

    function getTimmingKeys($is_upper_case = false)
    {
        $getTimings = config('timings');
		$temp = [];
		foreach ($getTimings as $key => $value) {
			foreach ($value as $timing => $val) {
                if($is_upper_case == true){
                    $temp[] = strtoupper($key.'_'.$timing);
                }else{
                    $temp[] = strtolower($key.'_'.$timing);
                }
				 
			}
		}
        return $temp;
    }

    function getCurrencies()
    {
        return Currency::all();
    }

    function setDefaultCurrency($id)
    {
        $this->updateSettingField('DEFAULT_CURRENCY_ID',$id,true);
    }

    function getDefaultCurrency()
    {
        return $this->getDecryptValue('DEFAULT_CURRENCY_ID');
    }

    function getCurrenciesConvertionWithRelationship($relation = [])
    {   
        return CurrencyConversion::with($relation)->get();
    }

    function getConversionRateAjax($source_currency_id,$internally = false)
    {
        $default_currency = $this->getDefaultCurrency();
        
        $check_exist = CurrencyConversion::where(
            'target_currency',$source_currency_id,
        )->where(
            'source_currency' , $default_currency
        )->first();
        if($check_exist == null){
            if($internally == false){
                return sendSuccess("No Currency Conversion Exist","0.00");
            }else{
                return "";
            }
        }else{
            if($internally == false){
                return sendSuccess("Currency Conversion Exists",$check_exist->closing_rate);
            }else{
                return $check_exist->closing_rate;
            }
        }
    }

    function addConversionRate($request = [])
    {
        $checkExists = $this->getConversionRateAjax($request['target_currency'],true);        
        if($checkExists == ''){
            CurrencyConversion::create([
                'id' => Str::uuid(), 
                'source_currency' => $request['source_currency'], 
                'target_currency' => $request['target_currency'], 
                'closing_rate' => $request['closing_rate'],  
                'created_by_id' => \Auth::id(),
            ]);
            return sendInternalSuccess('Currency Exchange Created Successfully');
        }else{
            CurrencyConversion::where('source_currency',$request['source_currency'])->where('target_currency',$request['target_currency'])->update([
                'closing_rate' => $request['closing_rate'], 
            ]);

            return sendInternalSuccess('Currency Exchange Updated Successfully');
        }
    }

    function updateSettingValue($data=[])
    {
        foreach ($data as $key => $value) {
            $this->updateSettingField($key,$value,true);
        }
    }
}
