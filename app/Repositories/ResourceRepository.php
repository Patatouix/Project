<?php

namespace App\Repositories;

abstract class ResourceRepository
{
    protected $model;

    public function getAllIndexedById()
    {
        return $this->model->get()->keyBy('id');
    }

    public function getPaginate($n)
	{
        return $this->model->paginate($n);
	}

	public function store(Array $inputs)
	{
		return $this->model->create($inputs);
	}

	public function getById($id)
	{
		return $this->model->findOrFail($id);
	}

	public function update($id, Array $inputs)
	{
		$this->getById($id)->update($inputs);
	}

	public function destroy($id)
	{
		$this->getById($id)->delete();
	}

	public function getAll()
	{
		return $this->model->all();
    }

    public function getOrderedBy($order)
    {
        return $this->model->orderBy($order);
    }

    public function getWhere($attribute, $value)
    {
        return $this->model->where($attribute, $value)->get();
    }
}