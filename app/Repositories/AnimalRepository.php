<?php

namespace App\Repositories;

use App\Animal;

class AnimalRepository extends ResourceRepository
{
    public function __construct(Animal $animal)
	{
		$this->model = $animal;
	}

	public function getAll()
	{
		return $this->model->orderBy('animals.created_at', 'desc');
	}

	public function getAllPaginate($n)
	{
		return $this->getAll()->paginate($n);
	}

	private function getAllbyUser($id)
	{
		return $this->model->where('user_id', $id)->orderBy('animals.name');
    }

	public function getAllByUserPaginate($id, $n)
	{
		return $this->getAllByUser($id)->paginate($n);
	}

	public function destroy($id)
	{
		$this->getById($id)->delete();
	}

	public function getById($id)
	{
		return $this->model->findOrFail($id);
	}

	public function update($id, Array $inputs)
	{
		$this->getById($id)->update($inputs);
    }

    public function getLastRegisteredAnimals()
    {
        return $this->model->orderBy('created_at', 'desc')->take(3)->get();
    }
}