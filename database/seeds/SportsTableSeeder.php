<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SportsTableSeeder extends Seeder
{
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
		DB::table('sports')->delete();

        for($i = 1; $i < 4; ++$i)
		{
            $date = $this->randDate();
            DB::table('sports')->insert(array(
                'name' => 'Sport ' . $i,
                'created_at' => $date,
                'updated_at' => $date
            ));
        }
	}
}
