<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ConseilsTableSeeder extends Seeder
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
        DB::table('conseils')->delete();

		for($i = 1; $i < 11; ++$i)
		{
            $date = $this->randDate();
			DB::table('conseils')->insert(array(
				'title' => 'Conseil ' . $i,
				'text' => 'Texte ' . $i,
				'created_at' => $date,
				'updated_at' => $date
			));
		}
    }
}
