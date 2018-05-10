<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CommandTableSeeder extends Seeder {

    private function randDate()
	{
		return Carbon::createFromDate(null, rand(1, 12), rand(1, 28));
	}

	public function run()
	{
		DB::table('commands')->delete();
		
		for($i = 0; $i < 25; ++$i)
		{
			$date = $this->randDate();
			DB::table('commands')->insert(array(
					'created_at' => $date,
					'updated_at' => $date,
					'id_user' => rand(1, 10),
					'id_article' => rand(1, 50),
				));
		}
	}
}