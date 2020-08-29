<?php

namespace App\Repositories;

use App\Sterilization;

class SterilizationRepository extends ResourceRepository
{
    public function __construct(Sterilization $sterilization)
	{
		$this->model = $sterilization;
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
		$sterilization = $this->model->findOrFail($id);
		$sterilization->delete();
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