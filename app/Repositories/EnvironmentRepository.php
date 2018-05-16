<?php

namespace App\Repositories;

use App\Environment;

class EnvironmentRepository extends ResourceRepository
{

    public function __construct(Environment $environment)
	{
		$this->model = $environment;
	}

}