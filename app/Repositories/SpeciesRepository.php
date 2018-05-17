<?php

namespace App\Repositories;

use App\Species;

class SpeciesRepository {

    protected $species;

    public function __construct(Species $species)
	{
		$this->species = $species;
	}

	public function getAll()
	{
		return $this->species->all();
	}

	public function getAllPaginate($n)
	{
		return $this->getAll()->paginate($n);
	}

	public function getByTagPaginate($tag, $n)
	{
		return $this->article->where('tag_id', $tag)->orderBy('articles.price')->paginate($n);	
	}

	public function store($inputs)
	{
		return $this->article->create($inputs);
	}

	public function destroy($id)
	{
		$article = $this->article->findOrFail($id);
		$article->delete();
	}

	public function getById($id)
	{
		return $this->article->findOrFail($id);
	}

	public function update($id, Array $inputs)
	{
		$this->getById($id)->update($inputs);
	}

}