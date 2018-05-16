<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RdvTableSeeder extends Seeder {

    private function randDate()
	{
		return Carbon::createFromDate(null, rand(1, 12), rand(1, 28));
	}

	public function run()
	{
		DB::table('rdvs')->delete();
		
		for($i = 1; $i < 51; ++$i)
		{
			$date = $this->randDate();
			DB::table('rdvs')->insert(array(
				'request' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
				'response' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
				'status' => rand(0, 1) ? 'En attente' : (rand(0, 1) ? 'Traité' : 'Confirmé'),
				'user_id' => rand(1, 50),
				'animal_id' => rand(1, 100),
				'vet_id' => rand(1, 5),
				'created_at' => $date,
				'updated_at' => $date
			));
		}
	}
}