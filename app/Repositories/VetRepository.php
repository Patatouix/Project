<?php

namespace App\Repositories;

use App\Vet;

class VetRepository extends ResourceRepository
{

    public function __construct(Vet $vet)
	{
		$this->model = $vet;
	}

}