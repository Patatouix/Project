<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class FoodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private function randDate()
	{
		return Carbon::createFromDate(null, rand(1, 12), rand(1, 28));
	}

	public function run()
	{
		DB::table('foods')->delete();
		
		for($i = 1; $i < 11; ++$i)
		{
			$date = $this->randDate();
			DB::table('foods')->insert(array(
				'name' => 'food' . $i,
				'advice' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris dignissim, nisi vitae pharetra tincidunt, ante urna bibendum lacus, in sagittis neque ligula finibus neque. Etiam vel magna pulvinar, lacinia tellus sit amet, aliquet mauris. Integer vitae dictum diam, mollis fermentum sem.',
				'created_at' => $date,
				'updated_at' => $date
			));
		}
	}
}
