<?php

namespace App\Modules\V1\Settings\Seeders;

use App\Modules\V1\Settings\Models\Currency;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class CurrencySeeder extends Seeder {

	public function run()
	{
		Currency::insert([
			[ 'id' => Str::uuid(),  'code' =>'AFN' , 'name' => 'Afghani', 'symbol' => '؋' ],
            [ 'id' => Str::uuid(),  'code' =>'ALL' , 'name' => 'Lek', 'symbol' => 'Lek' ],
            [ 'id' => Str::uuid(),  'code' =>'ANG' , 'name' => 'Netherlands Antillian Guilder', 'symbol' => 'ƒ' ],
            [ 'id' => Str::uuid(),  'code' =>'ARS' , 'name' => 'Argentine Peso', 'symbol' => '$' ],
            [ 'id' => Str::uuid(),  'code' =>'AUD' , 'name' => 'Australian Dollar', 'symbol' => '$' ],
            [ 'id' => Str::uuid(),  'code' =>'AWG' , 'name' => 'Aruban Guilder', 'symbol' => 'ƒ' ],
            [ 'id' => Str::uuid(),  'code' =>'AZN' , 'name' => 'Azerbaijanian Manat', 'symbol' => 'ман' ],
            [ 'id' => Str::uuid(),  'code' =>'BAM' , 'name' => 'Convertible Marks', 'symbol' => 'KM' ],
            [ 'id' => Str::uuid(),  'code' => 'BDT', 'name' => 'Bangladeshi Taka', 'symbol' => '৳'],
            [ 'id' => Str::uuid(),  'code' =>'BBD' , 'name' => 'Barbados Dollar', 'symbol' => '$' ],
            [ 'id' => Str::uuid(),  'code' =>'BGN' , 'name' => 'Bulgarian Lev', 'symbol' => 'лв' ],
            [ 'id' => Str::uuid(),  'code' =>'BMD' , 'name' => 'Bermudian Dollar', 'symbol' => '$' ],
            [ 'id' => Str::uuid(),  'code' =>'BND' , 'name' => 'Brunei Dollar', 'symbol' => '$' ],
            [ 'id' => Str::uuid(),  'code' =>'BOB' , 'name' => 'BOV Boliviano Mvdol', 'symbol' => '$b' ],
            [ 'id' => Str::uuid(),  'code' =>'BRL' , 'name' => 'Brazilian Real', 'symbol' => 'R$' ],
            [ 'id' => Str::uuid(),  'code' =>'BSD' , 'name' => 'Bahamian Dollar', 'symbol' => '$' ],
            [ 'id' => Str::uuid(),  'code' =>'BWP' , 'name' => 'Pula', 'symbol' => 'P' ],
            [ 'id' => Str::uuid(),  'code' =>'BYR' , 'name' => 'Belarussian Ruble', 'symbol' => '₽' ],
            [ 'id' => Str::uuid(),  'code' =>'BZD' , 'name' => 'Belize Dollar', 'symbol' => 'BZ$' ],
            [ 'id' => Str::uuid(),  'code' =>'CAD' , 'name' => 'Canadian Dollar', 'symbol' => '$' ],
            [ 'id' => Str::uuid(),  'code' =>'CHF' , 'name' => 'Swiss Franc', 'symbol' => 'CHF' ],
            [ 'id' => Str::uuid(),  'code' =>'CLP' , 'name' => 'CLF Chilean Peso Unidades de fomento', 'symbol' => '$' ],
            [ 'id' => Str::uuid(),  'code' =>'CNY' , 'name' => 'Yuan Renminbi', 'symbol' => '¥' ],
            [ 'id' => Str::uuid(),  'code' =>'COP' , 'name' => 'COU Colombian Peso Unidad de Valor Real', 'symbol' => '$' ],
            [ 'id' => Str::uuid(),  'code' =>'CRC' , 'name' => 'Costa Rican Colon', 'symbol' => '₡' ],
            [ 'id' => Str::uuid(),  'code' =>'CUP' , 'name' => 'CUC Cuban Peso Peso Convertible', 'symbol' => '₱' ],
            [ 'id' => Str::uuid(),  'code' =>'CZK' , 'name' => 'Czech Koruna', 'symbol' => 'Kč' ],
            [ 'id' => Str::uuid(),  'code' =>'DKK' , 'name' => 'Danish Krone', 'symbol' => 'kr' ],
            [ 'id' => Str::uuid(),  'code' =>'DOP' , 'name' => 'Dominican Peso', 'symbol' => 'RD$' ],
            [ 'id' => Str::uuid(),  'code' =>'EGP' , 'name' => 'Egyptian Pound', 'symbol' => '£' ],
            [ 'id' => Str::uuid(),  'code' =>'EUR' , 'name' => 'Euro', 'symbol' => '€' ],
            [ 'id' => Str::uuid(),  'code' =>'FJD' , 'name' => 'Fiji Dollar', 'symbol' => '$' ],
            [ 'id' => Str::uuid(),  'code' =>'FKP' , 'name' => 'Falkland Islands Pound', 'symbol' => '£' ],
            [ 'id' => Str::uuid(),  'code' =>'GBP' , 'name' => 'Pound Sterling', 'symbol' => '£' ],
            [ 'id' => Str::uuid(),  'code' =>'GIP' , 'name' => 'Gibraltar Pound', 'symbol' => '£' ],
            [ 'id' => Str::uuid(),  'code' =>'GTQ' , 'name' => 'Quetzal', 'symbol' => 'Q' ],
            [ 'id' => Str::uuid(),  'code' =>'GYD' , 'name' => 'Guyana Dollar', 'symbol' => '$' ],
            [ 'id' => Str::uuid(),  'code' =>'HKD' , 'name' => 'Hong Kong Dollar', 'symbol' => '$' ],
            [ 'id' => Str::uuid(),  'code' =>'HNL' , 'name' => 'Lempira', 'symbol' => 'L' ],
            [ 'id' => Str::uuid(),  'code' =>'HRK' , 'name' => 'Croatian Kuna', 'symbol' => 'kn' ],
            [ 'id' => Str::uuid(),  'code' =>'HUF' , 'name' => 'Forint', 'symbol' => 'Ft' ],
            [ 'id' => Str::uuid(),  'code' =>'IDR' , 'name' => 'Rupiah', 'symbol' => 'Rp' ],
            [ 'id' => Str::uuid(),  'code' =>'ILS' , 'name' => 'New Israeli Sheqel', 'symbol' => '₪' ],
            [ 'id' => Str::uuid(),  'code' =>'IRR' , 'name' => 'Iranian Rial', 'symbol' => '﷼' ],
            [ 'id' => Str::uuid(),  'code' =>'ISK' , 'name' => 'Iceland Krona', 'symbol' => 'kr' ],
            [ 'id' => Str::uuid(),  'code' =>'JMD' , 'name' => 'Jamaican Dollar', 'symbol' => 'J$' ],
            [ 'id' => Str::uuid(),  'code' =>'JPY' , 'name' => 'Yen', 'symbol' => '¥' ],
            [ 'id' => Str::uuid(),  'code' =>'KGS' , 'name' => 'Som', 'symbol' => 'лв' ],
            [ 'id' => Str::uuid(),  'code' =>'KHR' , 'name' => 'Riel', 'symbol' => '៛' ],
            [ 'id' => Str::uuid(),  'code' =>'KPW' , 'name' => 'North Korean Won', 'symbol' => '₩' ],
            [ 'id' => Str::uuid(),  'code' =>'KRW' , 'name' => 'Won', 'symbol' => '₩' ],
            [ 'id' => Str::uuid(),  'code' =>'KYD' , 'name' => 'Cayman Islands Dollar', 'symbol' => '$' ],
            [ 'id' => Str::uuid(),  'code' =>'KZT' , 'name' => 'Tenge', 'symbol' => 'лв' ],
            [ 'id' => Str::uuid(),  'code' =>'LAK' , 'name' => 'Kip', 'symbol' => '₭' ],
            [ 'id' => Str::uuid(),  'code' =>'LBP' , 'name' => 'Lebanese Pound', 'symbol' => '£' ],
            [ 'id' => Str::uuid(),  'code' =>'LKR' , 'name' => 'Sri Lanka Rupee', 'symbol' => '₨' ],
            [ 'id' => Str::uuid(),  'code' =>'LRD' , 'name' => 'Liberian Dollar', 'symbol' => '$' ],
            [ 'id' => Str::uuid(),  'code' =>'LTL' , 'name' => 'Lithuanian Litas', 'symbol' => 'Lt' ],
            [ 'id' => Str::uuid(),  'code' =>'LVL' , 'name' => 'Latvian Lats', 'symbol' => 'Ls' ],
            [ 'id' => Str::uuid(),  'code' =>'MKD' , 'name' => 'Denar', 'symbol' => 'ден' ],
            [ 'id' => Str::uuid(),  'code' =>'MNT' , 'name' => 'Tugrik', 'symbol' => '₮' ],
            [ 'id' => Str::uuid(),  'code' =>'MUR' , 'name' => 'Mauritius Rupee', 'symbol' => '₨' ],
            [ 'id' => Str::uuid(),  'code' =>'MXN' , 'name' => 'MXV Mexican Peso Mexican Unidad de Inversion (UDI]', 'symbol' => '$' ],
            [ 'id' => Str::uuid(),  'code' =>'MYR' , 'name' => 'Malaysian Ringgit', 'symbol' => 'RM' ],
            [ 'id' => Str::uuid(),  'code' =>'MZN' , 'name' => 'Metical', 'symbol' => 'MT' ],
            [ 'id' => Str::uuid(),  'code' =>'NGN' , 'name' => 'Naira', 'symbol' => '₦' ],
            [ 'id' => Str::uuid(),  'code' =>'NIO' , 'name' => 'Cordoba Oro', 'symbol' => 'C$' ],
            [ 'id' => Str::uuid(),  'code' =>'NOK' , 'name' => 'Norwegian Krone', 'symbol' => 'kr' ],
            [ 'id' => Str::uuid(),  'code' =>'NPR' , 'name' => 'Nepalese Rupee', 'symbol' => '₨' ],
            [ 'id' => Str::uuid(),  'code' =>'NZD' , 'name' => 'New Zealand Dollar', 'symbol' => '$' ],
            [ 'id' => Str::uuid(),  'code' =>'OMR' , 'name' => 'Rial Omani', 'symbol' => '﷼' ],
            [ 'id' => Str::uuid(),  'code' =>'PAB' , 'name' => 'USD Balboa US Dollar', 'symbol' => 'B/.' ],
            [ 'id' => Str::uuid(),  'code' =>'PEN' , 'name' => 'Nuevo Sol', 'symbol' => 'S/.' ],
            [ 'id' => Str::uuid(),  'code' =>'PHP' , 'name' => 'Philippine Peso', 'symbol' => 'Php' ],
            [ 'id' => Str::uuid(),  'code' =>'PKR' , 'name' => 'Pakistan Rupee', 'symbol' => '₨' ],
            [ 'id' => Str::uuid(),  'code' =>'PLN' , 'name' => 'Zloty', 'symbol' => 'zł' ],
            [ 'id' => Str::uuid(),  'code' =>'PYG' , 'name' => 'Guarani', 'symbol' => 'Gs' ],
            [ 'id' => Str::uuid(),  'code' =>'QAR' , 'name' => 'Qatari Rial', 'symbol' => '﷼' ],
            [ 'id' => Str::uuid(),  'code' =>'RON' , 'name' => 'New Leu', 'symbol' => 'lei' ],
            [ 'id' => Str::uuid(),  'code' =>'RSD' , 'name' => 'Serbian Dinar', 'symbol' => 'Дин.' ],
            [ 'id' => Str::uuid(),  'code' =>'RUB' , 'name' => 'Russian Ruble', 'symbol' => 'руб' ],
            [ 'id' => Str::uuid(),  'code' =>'SAR' , 'name' => 'Saudi Riyal', 'symbol' => '﷼' ],
            [ 'id' => Str::uuid(),  'code' =>'SBD' , 'name' => 'Solomon Islands Dollar', 'symbol' => '$' ],
            [ 'id' => Str::uuid(),  'code' =>'SCR' , 'name' => 'Seychelles Rupee', 'symbol' => '₨' ],
            [ 'id' => Str::uuid(),  'code' =>'SEK' , 'name' => 'Swedish Krona', 'symbol' => 'kr' ],
            [ 'id' => Str::uuid(),  'code' =>'SGD' , 'name' => 'Singapore Dollar', 'symbol' => '$' ],
            [ 'id' => Str::uuid(),  'code' =>'SHP' , 'name' => 'Saint Helena Pound', 'symbol' => '£' ],
            [ 'id' => Str::uuid(),  'code' =>'SOS' , 'name' => 'Somali Shilling', 'symbol' => 'S' ],
            [ 'id' => Str::uuid(),  'code' =>'SRD' , 'name' => 'Surinam Dollar', 'symbol' => '$' ],
            [ 'id' => Str::uuid(),  'code' =>'SVC' , 'name' => 'USD El Salvador Colon US Dollar', 'symbol' => '$' ],
            [ 'id' => Str::uuid(),  'code' =>'SYP' , 'name' => 'Syrian Pound', 'symbol' => '£' ],
            [ 'id' => Str::uuid(),  'code' =>'THB' , 'name' => 'Baht', 'symbol' => '฿' ],
            [ 'id' => Str::uuid(),  'code' =>'TRY' , 'name' => 'Turkish Lira', 'symbol' => 'TL' ],
            [ 'id' => Str::uuid(),  'code' =>'TTD' , 'name' => 'Trinidad and Tobago Dollar', 'symbol' => 'TT$' ],
            [ 'id' => Str::uuid(),  'code' =>'TWD' , 'name' => 'New Taiwan Dollar', 'symbol' => 'NT$' ],
            [ 'id' => Str::uuid(),  'code' =>'UAH' , 'name' => 'Hryvnia', 'symbol' => '₴' ],
            [ 'id' => Str::uuid(),  'code' =>'USD' , 'name' => 'US Dollar', 'symbol' => '$' ],
            [ 'id' => Str::uuid(),  'code' =>'UYU' , 'name' => 'UYI Uruguay Peso en Unidades Indexadas', 'symbol' => '$U' ],
            [ 'id' => Str::uuid(),  'code' =>'UZS' , 'name' => 'Uzbekistan Sum', 'symbol' => 'лв' ],
            [ 'id' => Str::uuid(),  'code' =>'VEF' , 'name' => 'Bolivar Fuerte', 'symbol' => 'Bs' ],
            [ 'id' => Str::uuid(),  'code' =>'VND' , 'name' => 'Dong', 'symbol' => '₫' ],
            [ 'id' => Str::uuid(),  'code' =>'XCD' , 'name' => 'East Caribbean Dollar', 'symbol' => '$' ],
            [ 'id' => Str::uuid(),  'code' =>'YER' , 'name' => 'Yemeni Rial', 'symbol' => '﷼' ],
            [ 'id' => Str::uuid(),  'code' =>'ZAR' , 'name' => 'Rand', 'symbol' => 'R' ],
		]);
	}

}