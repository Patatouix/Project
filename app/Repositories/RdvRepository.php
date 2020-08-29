<?php

namespace App\Repositories;

use App\Rdv;

class RdvRepository extends ResourceRepository
{
    public function __construct(Rdv $rdv)
	{
		$this->model = $rdv;
	}

	public function getAll()
	{
		return $this->model->orderBy('rdvs.updated_at', 'desc');
	}

	public function getAllPaginate($n)
	{
		return $this->getAll()->paginate($n);
	}

	public function getAllbyUser($id)
	{
		return $this->model->where('user_id', $id)->orderBy('rdvs.updated_at', 'desc');
    }

    public function getAllbyStatus($status)
	{
		return $this->model->where('status', $status)->orderBy('rdvs.created_at', 'desc');
    }

    public function getbyUserbyStatus($id, $status)
	{
		return $this->model->where('status', $status)->where('user_id', $id)->orderBy('rdvs.created_at', 'desc');
	}

	public function getAllByUserPaginate($id, $n)
	{
		return $this->getAllByUser($id)->paginate($n);
    }

    public function getAllByStatusPaginate($id, $n)
	{
		return $this->getAllbyStatus($id)->paginate($n);
    }

    public function getByUserByStatusPaginate($id, $status, $n)
	{
		return $this->getbyUserbyStatus($id, $status)->paginate($n);
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

    public function getLastRdvsForAdmin()
    {
        return $this->model->where('status', 'En attente')->orderBy('created_at', 'desc')->take(2)->get();
    }

    public function getLastRdvsForUser($id)
    {
        return $this->model->where('user_id', $id)->orderBy('created_at', 'desc')->take(2)->get();
    }
}