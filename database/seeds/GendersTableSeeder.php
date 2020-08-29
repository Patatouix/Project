<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class GendersTableSeeder extends Seeder
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
        DB::table('genders')->delete();

        for($i = 1; $i < 4; ++$i)
		{
            $date = $this->randDate();
            DB::table('genders')->insert(array(
                'name' => 'Genre ' . $i,
                'created_at' => $date,
                'updated_at' => $date
            ));
        }
    }
}
