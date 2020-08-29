<?php

namespace App\Repositories;

use App\User;

class UserRepository extends ResourceRepository
{
    public function __construct(User $user)
	{
		$this->model = $user;
	}

	public function getAllRecent()
	{
		return $this->model->orderBy('users.created_at', 'desc');
    }

    public function getNonAdmin()
	{
		return $this->model->where('admin', 0);
    }

    public function getLastRegisteredUsers()
    {
        return $this->model->where('admin', '!=', 1)->orderBy('created_at', 'desc')->take(3)->get();
    }
}