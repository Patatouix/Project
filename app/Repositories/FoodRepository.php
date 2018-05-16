<?php

namespace App\Repositories;

use App\Food;

class FoodRepository extends ResourceRepository
{

    public function __construct(Food $food)
	{
		$this->model = $food;
	}

}