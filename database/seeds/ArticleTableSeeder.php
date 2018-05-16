<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ArticleTableSeeder extends Seeder {

    private function randDate()
	{
		return Carbon::createFromDate(null, rand(1, 12), rand(1, 28));
	}

	public function run()
	{
		DB::table('articles')->delete();
		
		for($i = 1; $i < 51; ++$i)
		{
			$date = $this->randDate();
			DB::table('articles')->insert(array(
				'name' => 'article' . $i,
				'price' => rand(1, 100),
				'short_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
				'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris dignissim, nisi vitae pharetra tincidunt, ante urna bibendum lacus, in sagittis neque ligula finibus neque. Etiam vel magna pulvinar, lacinia tellus sit amet, aliquet mauris. Integer vitae dictum diam, mollis fermentum sem.',
				'image' => 'https://www.zoomalia.com/blogz/7/l_la_cat-chow-adulte-special-boule-de-poils-19873.jpg',
				'id_tag' => rand(1, 10),
				'created_at' => $date,
				'updated_at' => $date
			));
		}
	}
}