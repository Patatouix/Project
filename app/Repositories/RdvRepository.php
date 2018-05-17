<?php

namespace App\Repositories;

use App\Rdv;

class RdvRepository {

    protected $rdv;

    public function __construct(Rdv $rdv)
	{
		$this->rdv = $rdv;
	}

	public function getAll()
	{
		return $this->rdv->orderBy('rdvs.created_at', 'desc');		
	}

	public function getAllPaginate($n)
	{
		return $this->getAll()->paginate($n);
	}

	private function getAllbyUser($id)
	{
		return $this->rdv->where('user_id', $id)->orderBy('rdvs.created_at', 'desc');
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
		return $this->rdv->create($inputs);
	}

	public function destroy($id)
	{
		$this->getById($id)->delete();
	}

	public function getById($id)
	{
		return $this->rdv->findOrFail($id);
	}

	public function update($id, Array $inputs)
	{
		$this->getById($id)->update($inputs);
	}

}