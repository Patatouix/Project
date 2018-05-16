<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class VetTableSeeder extends Seeder
{
	private function randDate()
	{
		return Carbon::createFromDate(null, rand(1, 12), rand(1, 28));
	}
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
	{
		DB::table('vets')->delete();

		for($i = 1; $i < 6; ++$i)
		{
			$date = $this->randDate();
			DB::table('vets')->insert([
				'name' => 'Véto' . $i,
				'created_at' => $date,
				'updated_at' => $date
			]);
		}
	}
}
