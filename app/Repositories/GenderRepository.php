<?php

namespace App\Repositories;

use App\Gender;

class GenderRepository extends ResourceRepository
{
    public function __construct(Gender $gender)
	{
		$this->model = $gender;
	}

	public function getAll()
	{
		return $this->model->orderBy('name')->get();
	}

	public function getAllPaginate($n)
	{
		return $this->getAll()->paginate($n);
	}

	public function getByTagPaginate($tag, $n)
	{
		return $this->model->where('tag_id', $tag)->orderBy('name')->paginate($n);
	}

	public function destroy($id)
	{
		$gender = $this->model->findOrFail($id);
		$gender->delete();
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