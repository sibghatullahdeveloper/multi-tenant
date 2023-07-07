<?php

namespace App\Modules\V1\Commons\Seeders;

use App\Modules\V1\Commons\Models\Menu;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MenuSeeder extends Seeder {

	public function run()
	{
		Menu::create(
			[
				"uuid"=>Str::uuid(),
				'title' => 'Users', 
				'slug' => 'users', 
				'link' => '/users',
				'icon' => '',
				'description' => 'User Module', 
				'type' => 'sidebar', 
				'sorting_order' => 2,
				'created_by_id' => 1,
				'active' => '1'
			]
		);

		Menu::create(			
			[
				"uuid"=>Str::uuid(),
				'title' => 'Roles', 
				'slug' => 'roles',
				'link' => '/roles',
				'icon' => '', 
				'description' => 'Role Module', 
				'type' => 'sidebar',
				'sorting_order' => 2, 
				'created_by_id' => 1,
				'active' => '1'
			]
		);

		Menu::create(			
			[
				"uuid"=>Str::uuid(),
				'title' => 'Category', 
				'slug' => 'category',
				'link' => '/category',
				'icon' => '', 
				'description' => 'Category Module', 
				'type' => 'sidebar',
				'sorting_order' => 3, 
				'created_by_id' => 1,
				'active' => '1'
			]
		);

		Menu::create(			
			[
				"uuid"=>Str::uuid(),
				'title' => 'Settings', 
				'slug' => 'settings',
				'link' => '/settings',
				'icon' => '', 
				'description' => 'Settings Module', 
				'type' => 'sidebar',
				'sorting_order' => 4, 
				'created_by_id' => 1,
				'active' => '1'
			]
		);

		Menu::create(			
			[
				"uuid"=>Str::uuid(),
				'title' => 'Pages', 
				'slug' => 'pages',
				'link' => '/pages',
				'icon' => '', 
				'description' => 'Pages Module', 
				'type' => 'sidebar',
				'sorting_order' => 5, 
				'created_by_id' => 1,
				'active' => '1'
			]
		);

		Menu::create(			
			[
				"uuid"=>Str::uuid(),
				'title' => 'Seo', 
				'slug' => 'seo',
				'link' => '/seo',
				'icon' => '', 
				'description' => 'Seo Module', 
				'type' => 'sidebar',
				'sorting_order' => 6, 
				'created_by_id' => 1,
				'active' => '1'
			]
		);

		Menu::create(			
			[
				"uuid"=>Str::uuid(),
				'title' => 'Features', 
				'slug' => 'features',
				'link' => '/features',
				'icon' => '', 
				'description' => 'Features Module', 
				'type' => 'sidebar',
				'sorting_order' => 7, 
				'created_by_id' => 1,
				'active' => '1'
			]
		);

		Menu::create(			
			[
				"uuid"=>Str::uuid(),
				'title' => 'Product', 
				'slug' => 'product',
				'link' => '/product',
				'icon' => '', 
				'description' => 'Product Module', 
				'type' => 'sidebar',
				'sorting_order' => 8, 
				'created_by_id' => 1,
				'active' => '1'
			]
		);
	}

}