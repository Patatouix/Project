<?php

namespace App\Repositories;

use App\Sport;

class SportRepository extends ResourceRepository
{
    public function __construct(Sport $sport)
	{
		$this->model = $sport;
    }

    public function getAll()
	{
		return $this->model->orderBy('name')->get();
	}
}