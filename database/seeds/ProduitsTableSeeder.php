<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProduitsTableSeeder extends Seeder {

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
		DB::table('produits')->delete();

		for($i = 1; $i < 11; ++$i)
		{
			$date = $this->randDate();
			DB::table('produits')->insert(array(
				'name' => 'Produit ' . $i,
				'price' => rand(1, 100),
				'short_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
				'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris dignissim, nisi vitae pharetra tincidunt, ante urna bibendum lacus, in sagittis neque ligula finibus neque. Etiam vel magna pulvinar, lacinia tellus sit amet, aliquet mauris. Integer vitae dictum diam, mollis fermentum sem.',
				'created_at' => $date,
				'updated_at' => $date
			));
		}
	}
}