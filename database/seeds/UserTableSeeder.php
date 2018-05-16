<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder {

	private function randDate()
	{
		return Carbon::createFromDate(null, rand(1, 12), rand(1, 28));
	}

    public function run()
	{
		DB::table('users')->delete();

		for($i = 1; $i < 51; ++$i)
		{
			$date = $this->randDate();
			DB::table('users')->insert([
				'name' => 'Nom' . $i,
				'email' => 'email' . $i . '@blop.fr',
				'password' => bcrypt('password' . $i),
				'admin' => rand(0, 1),
				'created_at' => $date,
				'updated_at' => $date
			]);
		}
	}
}	