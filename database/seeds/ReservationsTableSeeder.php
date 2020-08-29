<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ReservationsTableSeeder extends Seeder {

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

		DB::table('reservations')->delete();

		for($i = 1; $i < 11; ++$i)
		{
			$date = $this->randDate();
			DB::table('reservations')->insert(array(
                'takeout' => $date,
                'user_id' => rand(1, 10),
				'status' => 'Archivée',
				'created_at' => $date,
				'updated_at' => $date,
			));
		}
	}
}