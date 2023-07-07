<?php

namespace App\Modules\V1\Commons\Seeders;

use App\Modules\V1\Users\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {

	public function run()
	{
		User::create([
			'uuid' => Str::uuid(),
			'role_id' => 1, 
			'first_name' => 'Super', 
			'last_name' => 'Admin', 
			'email' => 'info@admin.com', 
			'password' => Hash::make('123456'), 
			'type' => 'admin', 
			'phone_number' => '+923084532330',
			'lat' => '22.05456',
			'long' => '-37.05456', 
            'image_path' => '',
			'updated_at' => date('u'),
		]);
	}

}