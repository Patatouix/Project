<?php

namespace App\Repositories;

use App\Conseil;

class ConseilRepository extends ResourceRepository
{
    public function __construct(Conseil $conseil)
	{
		$this->model = $conseil;
	}

	public function getAll()
	{
		return $this->model->orderBy('created_at', 'desc')->get();
	}

	public function getAllPaginate($n)
	{
		return $this->model->paginate($n);
	}

	private function getAllbyUser($id)
	{
		return $this->model->where('user_id', $id)->orderBy('conseil.name');
	}

	public function getAllByUserPaginate($id, $n)
	{
		return $this->getAllByUser($id)->paginate($n);
	}

	public function getByTagPaginate($tag, $n)
	{
		return $this->model->where('tag_id', $tag)->orderBy('conseil.price')->paginate($n);
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

    public function getByConseiltagPaginate($tag, $nb)
    {
        return $this->model->whereHas('conseiltags', function($q) use ($tag) {
            $q->where('conseiltags.id', '=', $tag);
        })->paginate($nb);
    }
}