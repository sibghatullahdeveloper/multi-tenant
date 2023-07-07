<?php

namespace App\Modules\V1\Features\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class FeatureSeeders extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			
		}
	}

}