<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ConseilSterilizationTableSeeder extends Seeder
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
        DB::table('conseil_sterilization')->delete();

		for($i = 1; $i < 25; ++$i)
		{
            $date = $this->randDate();
			DB::table('conseil_sterilization')->insert(array(
				'sterilization_id' => rand(1, 10),
				'conseil_id' => rand(1, 10),
				'created_at' => $date,
				'updated_at' => $date
			));
		}
    }
}
