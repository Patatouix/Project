<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AnimalsTableSeeder extends Seeder {

    private function randDate()
	{
		return Carbon::createFromDate(rand(2015, 2018), rand(1, 12), rand(1, 28));
	}

	/**
     * Run the database seeds.
     *
     * @return void
     */
	public function run()
	{
		DB::table('animals')->delete();

		for($i = 1; $i < 11; ++$i)
		{
			$date = $this->randDate();
			DB::table('animals')->insert(array(
                'name' => 'Animal ' . $i,
                'user_id' => rand(1, 10),
                'espece_id' => rand(1, 3),
                'sport_id' => rand(1, 3),
                'age_id' => rand(1, 3),
                'gender_id' => rand(1, 3),
                'weight_id' => rand(1, 3),
				'sterilization_id' => rand(1, 3),
				'created_at' => $date,
				'updated_at' => $date
			));
		}
	}
}