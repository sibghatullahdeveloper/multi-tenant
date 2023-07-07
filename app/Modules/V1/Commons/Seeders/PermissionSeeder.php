<?php

namespace App\Modules\V1\Commons\Seeders;

use App\Modules\V1\Commons\Models\Permission;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PermissionSeeder extends Seeder {

	public function run()
	{
		Permission::create([
			"uuid"=>Str::uuid(),
			'title' => 'Create', 
			'slug' => 'create', 
			'description' => 'Create Permissions', 
			'type' => 'create', 
			'created_by_id' => 1,
			'active' => '1'
		]);

		Permission::create([
			"uuid"=>Str::uuid(),
			'title' => 'View', 
			'slug' => 'view', 
			'description' => 'View Permissions', 
			'type' => 'view', 
			'created_by_id' => 1,
			'active' => '1'
		]);

		Permission::create([
			"uuid"=>Str::uuid(),
			'title' => 'Update', 
			'slug' => 'update', 
			'description' => 'Update Permissions', 
			'type' => 'update', 
			'created_by_id' => 1,
			'active' => '1'
		]);

		Permission::create([
			"uuid"=>Str::uuid(),
			'title' => 'delete', 
			'slug' => 'delete', 
			'description' => 'Has delete Permissions', 
			'type' => 'delete', 
			'created_by_id' => 1,
			'active' => '1'
		]);


		
	}

}