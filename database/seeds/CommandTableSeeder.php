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
		
		for($i = 1; $i < 26; ++$i)
		{
			$date = $this->randDate();
			DB::table('commands')->insert(array(
				'created_at' => $date,
				'updated_at' => $date,
				'user_id' => rand(1, 10),
				'article_id' => rand(1, 50),
			));
		}
	}
}