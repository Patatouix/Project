<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RdvsTableSeeder extends Seeder {

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

		DB::table('rdvs')->delete();

		for($i = 1; $i < 11; ++$i)
		{
			$date = $this->randDate();
			DB::table('rdvs')->insert(array(
				'request' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
				'status' => 'Archivé',
				'user_id' => rand(1, 10),
				'vet_id' => rand(1, 5),
				'created_at' => $date,
				'updated_at' => $date
			));
		}
	}
}