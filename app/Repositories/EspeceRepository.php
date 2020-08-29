<?php

namespace App\Repositories;

use App\Espece;

class EspeceRepository extends ResourceRepository
{
    public function __construct(Espece $espece)
	{
		$this->model = $espece;
	}

	public function getAll()
	{
		return $this->model->orderBy('name')->get();
	}

	public function getAllPaginate($n)
	{
		return $this->getAll()->paginate($n);
	}

	public function destroy($id)
	{
		$espece = $this->model->findOrFail($id);
		$espece->delete();
	}

	public function getById($id)
	{
		return $this->model->findOrFail($id);
	}

	public function update($id, Array $inputs)
	{
		$this->getById($id)->update($inputs);
	}
}