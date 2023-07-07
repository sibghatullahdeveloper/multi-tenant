<?php

namespace Database\Seeders;

use App\Modules\V1\Categories\Seeders\CategorySeeder;
use App\Modules\V1\Commons\Models\Permission;
use App\Modules\V1\Commons\Seeders\MenuPermissionMappingSeeder;
use App\Modules\V1\Commons\Seeders\MenuSeeder;
use App\Modules\V1\Commons\Seeders\PermissionSeeder;
use App\Modules\V1\Commons\Seeders\RoleSeeder;
use App\Modules\V1\Commons\Seeders\UserSeeder;
use App\Modules\V1\Pages\Seeders\PageSeeder;
use App\Modules\V1\Seo\Seeders\SeoSeeder;
use App\Modules\V1\Settings\Seeders\CurrencySeeder;
use App\Modules\V1\Settings\Seeders\SettingSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            MenuSeeder::class,
            PermissionSeeder::class,
            MenuPermissionMappingSeeder::class,
            SettingSeeder::class,
            CurrencySeeder::class,
            CategorySeeder::class,
            PageSeeder::class,
            SeoSeeder::class,
        ]);
    }
}
