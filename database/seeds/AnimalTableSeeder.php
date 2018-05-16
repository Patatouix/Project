<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AnimalTableSeeder extends Seeder {

    private function randDate()
	{
		return Carbon::createFromDate(null, rand(1, 12), rand(1, 28));
	}

	public function run()
	{
		DB::table('animals')->delete();
		
		for($i = 1; $i < 101; ++$i)
		{
			$date = $this->randDate();
			DB::table('animals')->insert(array(
				'name' => 'animal' . $i,
				'weight' => (rand(1, 30) + (rand(1, 10) / 10)),
				'age' => (rand(1, 20) + (rand(1, 10) / 10)),
				'sterilization' => rand(0, 1),
				'gender' => rand(0, 1) ? 'Male' : 'Femelle',
				'image' => 'https://png.pngtree.com/element_origin_min_pic/00/16/05/135735977b209c0.jpg',
				'user_id' => rand(1, 25),
				'species_id' => rand(1, 10),
				'environment_id' => rand(1, 10),
				'sport_id' => rand(1, 10),
				'food_id' => rand(1, 10),
				'race_id' => rand(1, 50),
				'created_at' => $date,
				'updated_at' => $date
			));
		}
	}
}