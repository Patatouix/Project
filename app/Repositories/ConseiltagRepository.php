<?php

namespace App\Repositories;

use App\Conseiltag;

class ConseiltagRepository extends ResourceRepository
{
    public function __construct(Conseiltag $conseiltag)
	{
		$this->model = $conseiltag;
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
		$conseiltag = $this->model->findOrFail($id);
		$conseiltag->delete();
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