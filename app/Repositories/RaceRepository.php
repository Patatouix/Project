<?php

namespace App\Repositories;

use App\Race;

class RaceRepository extends ResourceRepository
{
    public function __construct(Race $race)
	{
		$this->model = $race;
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
		$race = $this->model->findOrFail($id);
		$race->delete();
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