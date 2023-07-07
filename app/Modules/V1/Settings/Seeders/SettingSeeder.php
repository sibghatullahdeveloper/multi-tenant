<?php

namespace App\Modules\V1\Settings\Seeders;

use App\Modules\V1\Settings\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class SettingSeeder extends Seeder {

	public function run()
	{
		Setting::create([
			"id"=>Str::uuid(),
			's_key' => 'BUSINESS_NAME', 
			's_value' => Crypt::encryptString('Multi Tenant'), 
			'created_by_id' => 1
		]);


		Setting::create([
			"id"=>Str::uuid(),
			's_key' => 'MAILGUN_USERNAME', 
			's_value' => '', 
			'created_by_id' => 1
		]);

		Setting::create([
			"id"=>Str::uuid(),
			's_key' => 'MAILGUN_PASSWORD', 
			's_value' => '', 
			'created_by_id' => 1
		]);


		Setting::create([
			"id"=>Str::uuid(),
			's_key' => 'SMTP_USERNAME', 
			's_value' => '', 
			'created_by_id' => 1
		]);


		Setting::create([
			"id"=>Str::uuid(),
			's_key' => 'SMTP_PASSWORD', 
			's_value' => '', 
			'created_by_id' => 1
		]);


		Setting::create([
			"id"=>Str::uuid(),
			's_key' => 'SMTP_HOST', 
			's_value' => '', 
			'created_by_id' => 1
		]);

		Setting::create([
			"id"=>Str::uuid(),
			's_key' => 'SMTP_PORT', 
			's_value' => '', 
			'created_by_id' => 1
		]);


		Setting::create([
			"id"=>Str::uuid(),
			's_key' => 'PAYPAL_API_USERNAME', 
			's_value' => '', 
			'created_by_id' => 1
		]);

		Setting::create([
			"id"=>Str::uuid(),
			's_key' => 'PAYPAL_API_PASSWORD', 
			's_value' => '', 
			'created_by_id' => 1
		]);

		Setting::create([
			"id"=>Str::uuid(),
			's_key' => 'PAYPAL_MODE', 
			's_value' => '', 
			'created_by_id' => 1
		]);

		Setting::create([
			"id"=>Str::uuid(),
			's_key' => 'PAYPAL_API_CLIENT_ID', 
			's_value' => '', 
			'created_by_id' => 1
		]);

		Setting::create([
			"id"=>Str::uuid(),
			's_key' => 'PAYPAL_API_SECRET', 
			's_value' => '', 
			'created_by_id' => 1
		]);


		Setting::create([
			"id"=>Str::uuid(),
			's_key' => 'PAYPAL_API_CERTIFICATE', 
			's_value' => '', 
			'created_by_id' => 1
		]);

		Setting::create([
			"id"=>Str::uuid(),
			's_key' => 'TAX', 
			's_value' => '', 
			'created_by_id' => 1
		]);

		Setting::create([
			"id"=>Str::uuid(),
			's_key' => 'VAT', 
			's_value' => '', 
			'created_by_id' => 1
		]);

		Setting::create([
			"id"=>Str::uuid(),
			's_key' => 'BUSINESS_PHONE_NUMBER', 
			's_value' => '', 
			'created_by_id' => 1
		]);

		Setting::create([
			"id"=>Str::uuid(),
			's_key' => 'BUSINESS_WHATSAPP_NUMBER', 
			's_value' => '', 
			'created_by_id' => 1
		]);

		Setting::create([
			"id"=>Str::uuid(),
			's_key' => 'CONTACT_EMAIL', 
			's_value' => '', 
			'created_by_id' => 1
		]);

		Setting::create([
			"id"=>Str::uuid(),
			's_key' => 'BUSINESS_LOCATION', 
			's_value' => '', 
			'created_by_id' => 1
		]);

		Setting::create([
			"id"=>Str::uuid(),
			's_key' => 'BUSINESS_LAT', 
			's_value' => '', 
			'created_by_id' => 1
		]);

		Setting::create([
			"id"=>Str::uuid(),
			's_key' => 'BUSINESS_LONG', 
			's_value' => '', 
			'created_by_id' => 1
		]);

		Setting::create([
			"id"=>Str::uuid(),
			's_key' => 'BUSINESS_ADDRESS', 
			's_value' => '', 
			'created_by_id' => 1
		]);


		Setting::create([
			"id"=>Str::uuid(),
			's_key' => 'FACEBOOK_APP_ID', 
			's_value' => '', 
			'created_by_id' => 1
		]);


		Setting::create([
			"id"=>Str::uuid(),
			's_key' => 'GOOGLE_APP_ID', 
			's_value' => '', 
			'created_by_id' => 1
		]);


		Setting::create([
			"id"=>Str::uuid(),
			's_key' => 'APPLE_APP_ID', 
			's_value' => '', 
			'created_by_id' => 1
		]);


		Setting::create([
			"id"=>Str::uuid(),
			's_key' => 'TWITTER_APP_ID', 
			's_value' => '', 
			'created_by_id' => 1
		]);


		/**Create Timings */
		$getTimings = config('timings');
		
		foreach ($getTimings as $key => $value) {
			foreach ($value as $timing => $val) {
				Setting::create([
					"id"=>Str::uuid(),
					's_key' => $key.'_'.$timing, 
					's_value' => '', 
					'created_by_id' => 1
				]);
			}
		}


		Setting::create([
			"id"=>Str::uuid(),
			's_key' => 'DEFAULT_CURRENCY_ID', 
			's_value' => '', 
			'created_by_id' => 1
		]);


		/**Email Settings */
		
		Setting::create([
			"id"=>Str::uuid(),
			's_key' => 'SENDER_NAME', 
			's_value' => '', 
			'created_by_id' => 1
		]);


		Setting::create([
			"id"=>Str::uuid(),
			's_key' => 'REPLY_TO_ADDRESS', 
			's_value' => '', 
			'created_by_id' => 1
		]);


		/**Mobile App Link */
		Setting::create([
			"id"=>Str::uuid(),
			's_key' => 'ANDROID_APP_LINK', 
			's_value' => '', 
			'created_by_id' => 1
		]);

		Setting::create([
			"id"=>Str::uuid(),
			's_key' => 'IOS_APP_LINK', 
			's_value' => '', 
			'created_by_id' => 1
		]);
		
		/**Order Amounts */
		
		Setting::create([
			"id"=>Str::uuid(),
			's_key' => 'MINIMUM_ORDER_AMOUNT', 
			's_value' => '', 
			'created_by_id' => 1
		]);

		Setting::create([
			"id"=>Str::uuid(),
			's_key' => 'MINIMUM_ORDER_AMOUNT_FREE_DELIVERY', 
			's_value' => '', 
			'created_by_id' => 1
		]);


		Setting::create([
			"id"=>Str::uuid(),
			's_key' => 'PAYMENT_METHOD_CASH_ON_DELIVERY', 
			's_value' => '', 
			'created_by_id' => 1
		]);


		Setting::create([
			"id"=>Str::uuid(),
			's_key' => 'PAYMENT_METHOD_PAYPAL', 
			's_value' => '', 
			'created_by_id' => 1
		]);


		Setting::create([
			"id"=>Str::uuid(),
			's_key' => 'PAYMENT_METHOD_STRIPE', 
			's_value' => '', 
			'created_by_id' => 1
		]);




		/**Social Logins */

		Setting::create([
			"id"=>Str::uuid(),
			's_key' => 'SOCIAL_FACEBOOK', 
			's_value' => '', 
			'created_by_id' => 1
		]);


		Setting::create([
			"id"=>Str::uuid(),
			's_key' => 'SOCIAL_INSTAGRAM', 
			's_value' => '', 
			'created_by_id' => 1
		]);

		Setting::create([
			"id"=>Str::uuid(),
			's_key' => 'SOCIAL_LINKEDIN', 
			's_value' => '', 
			'created_by_id' => 1
		]);

		Setting::create([
			"id"=>Str::uuid(),
			's_key' => 'SOCIAL_TWITTER', 
			's_value' => '', 
			'created_by_id' => 1
		]);

		Setting::create([
			"id"=>Str::uuid(),
			's_key' => 'SOCIAL_SNAPCHAT', 
			's_value' => '', 
			'created_by_id' => 1
		]);

		Setting::create([
			"id"=>Str::uuid(),
			's_key' => 'SOCIAL_WHATSAPP', 
			's_value' => '', 
			'created_by_id' => 1
		]);

		Setting::create([
			"id"=>Str::uuid(),
			's_key' => 'SOCIAL_YOUTUBE', 
			's_value' => '', 
			'created_by_id' => 1
		]);

		Setting::create([
			"id"=>Str::uuid(),
			's_key' => 'SOCIAL_GOOGLE_BUSSINESS', 
			's_value' => '', 
			'created_by_id' => 1
		]);

		Setting::create([
			"id"=>Str::uuid(),
			's_key' => 'SOCIAL_GITHUB', 
			's_value' => '', 
			'created_by_id' => 1
		]);

	}

}