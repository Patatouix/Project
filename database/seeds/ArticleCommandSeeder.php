<?php

use Illuminate\Database\Seeder;

class ArticleCommandTableSeeder extends Seeder {

    public function run()
    {
		for($i = 1; $i <= 100; ++$i)
		{
			$numbers = range(1, 25);
			shuffle($numbers);
			$n = rand(3, 6);
			for($j = 1; $j < $n; ++$j)
			{
				DB::table('article_command')->insert(array(
					'command_id' => $i,
					'article_id' => $numbers[$j]
				));
			}
		}
	}
}