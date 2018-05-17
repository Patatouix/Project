<?php

namespace App\Repositories;

use App\Animal;

class AnimalRepository {

    protected $animal;

    public function __construct(Animal $animal)
	{
		$this->animal = $animal;
	}

	public function getAll()
	{
		return $this->animal->orderBy('animals.name');		
	}

	public function getAllPaginate($n)
	{
		return $this->getAll()->paginate($n);
	}

	private function getAllbyUser($id)
	{
		return $this->animal->where('user_id', $id)->orderBy('animals.name');		
	}

	public function getAllByUserPaginate($id, $n)
	{
		return $this->getAllByUser($id)->paginate($n);
	}

	public function getByTagPaginate($tag, $n)
	{
		return $this->article->where('tag_id', $tag)->orderBy('articles.price')->paginate($n);	
	}

	public function store($inputs)
	{
		return $this->animal->create($inputs);
	}

	public function destroy($id)
	{
		$this->getById($id)->delete();
	}

	public function getById($id)
	{
		return $this->animal->findOrFail($id);
	}

	public function update($id, Array $inputs)
	{
		$this->getById($id)->update($inputs);
	}

}