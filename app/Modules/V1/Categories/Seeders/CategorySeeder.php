<?php

namespace App\Modules\V1\Categories\Seeders;

use App\Modules\V1\Categories\Models\Category;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder {

	public function run()
	{
		Category::create([
			'id' => Str::uuid(),  
			'title' => 'Electronics', 
			'description' => 'Electronics Category',  
			'created_by_id' => '1',
		]);
	}

}