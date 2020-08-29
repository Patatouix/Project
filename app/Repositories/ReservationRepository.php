<?php

namespace App\Repositories;

use App\Reservation;

class ReservationRepository extends ResourceRepository
{
    public function __construct(Reservation $reservation)
	{
		$this->model = $reservation;
	}

	public function getAllbyUser($id)
	{
		return $this->model->where('user_id', $id)->orderBy('reservations.created_at', 'desc');
    }

    public function getAllbyStatus($status)
	{
		return $this->model->where('status', $status)->orderBy('reservations.created_at', 'desc');
    }

    public function getbyUserbyStatus($id, $status)
	{
		return $this->model->where('status', $status)->where('user_id', $id)->orderBy('reservations.created_at', 'desc');
	}

	public function getAll()
	{
		return $this->model->orderBy('reservations.updated_at', 'desc');
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

	public function getAllPaginate($n)
	{
		return $this->getAll()->paginate($n);
	}

	public function destroy($id)
	{
		$reservation = $this->model->findOrFail($id);
		$reservation->delete();
	}

	public function getById($id)
	{
		return $this->model->findOrFail($id);
	}

	public function update($id, Array $inputs)
	{
		$reservation = $this->getById($id);
		$reservation->update($inputs);
		$reservation->status ='Validée';
		$reservation->save();
	}

	public function archive($id)
	{
		$reservation = $this->getById($id);
		$reservation->status ='Archivée';
		$reservation->save();
    }

    public function getByUser($user_id)
    {
        return $this->model->where('user_id', $user_id)->where('status', '!=', 'Archivée')->get();
    }

    public function getLastReservationsForAdmin()
    {
        return $this->model->where('status', 'En attente')->orderBy('created_at', 'desc')->take(2)->get();
    }

    public function getLastReservationsForUser($id)
    {
        return $this->model->where('user_id', $id)->orderBy('created_at', 'desc')->take(2)->get();
    }
}