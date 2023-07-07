<?php

namespace App\Modules\V1\Commons\Seeders;

use App\Modules\V1\Commons\Models\Menu;
use App\Modules\V1\Commons\Models\Permission;
use App\Modules\V1\Commons\Models\RoleMenuPermission;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class MenuPermissionMappingSeeder extends Seeder {

	public function run()
	{
		$menus = Menu::where('id','>','0')->get();
		$permissions = Permission::where('id','>','0')->get();

		foreach ($menus as $menu) {
			foreach ($permissions as $permission) {
				RoleMenuPermission::create(
					[
						'menu_id' => $menu->id, 
						'permission_id' => $permission->id, 
						'role_id' => 1,
					]
				);
			}
		}
	}

}