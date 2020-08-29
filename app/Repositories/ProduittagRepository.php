<?php
namespace App\Repositories;

use App\Produittag;

class ProduittagRepository extends ResourceRepository
{
    public function __construct(Produittag $produittag)
	{
		$this->model = $produittag;
	}

	public function getAll()
	{
		return $this->model->orderBy('name')->get();
	}

	public function getById($id)
	{
		return $this->model->find($id);
	}
}