<?php

namespace App\Repositories;

use App\Race;

class RaceRepository {

    protected $race;

    public function __construct(Race $race)
	{
		$this->race = $race;
	}

	public function getAll()
	{
		return $this->race->all();
	}

	public function getAllPaginate($n)
	{
		return $this->getAll()->paginate($n);
	}

	public function getByTagPaginate($tag, $n)
	{
		return $this->article->where('id_tag', $tag)->orderBy('articles.price')->paginate($n);	
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