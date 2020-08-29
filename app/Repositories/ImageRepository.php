<?php

namespace App\Repositories;

use App\Image;

class ImageRepository extends ResourceRepository
{
    public function __construct(Image $image)
	{
		$this->model = $image;
    }

    public function createIfNotExists(Array $condition)
    {
        return $this->model->firstOrCreate($condition);
    }
}