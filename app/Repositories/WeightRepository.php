<?php

namespace App\Repositories;

use App\Weight;

class WeightRepository extends ResourceRepository
{
    public function __construct(Weight $weight)
	{
		$this->model = $weight;
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
		$weight = $this->model->findOrFail($id);
		$weight->delete();
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