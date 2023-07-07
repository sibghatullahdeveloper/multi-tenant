<?php

namespace App\Modules\V1\Commons\Seeders;

use App\Modules\V1\Roles\Models\Role;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder {

	public function run()
	{
		/**
		 * 
		 * First make role
		 * 
		 */
		Role::create([
			'uuid' => Str::uuid(),
			'title' => 'Super-Admin', 
			'slug' => 'super-admin', 
			'description' => 'Has All Permissions', 
			'type' => 'admin', 
			'created_by_id' => 0,
			'active' => '1'
		]);
	}

}