<?php

namespace App\Repositories;

use App\Age;

class AgeRepository extends ResourceRepository
{
    public function __construct(Age $age)
	{
		$this->model = $age;
    }

    public function getAll()
	{
		return $this->model->orderBy('name')->get();
	}
}