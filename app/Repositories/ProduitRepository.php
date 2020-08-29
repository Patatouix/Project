<?php

namespace App\Repositories;

use App\Produit;

class ProduitRepository extends ResourceRepository
{
    public function __construct(Produit $produit)
	{
		$this->model = $produit;
	}

	public function getAll()
	{
		return $this->model->orderBy('produits.price');
	}

	public function getAllPaginate($n)
	{
		return $this->getAll()->paginate($n);
	}

	public function destroy($id)
	{
		$produit = $this->model->findOrFail($id);
		$produit->delete();
	}

	public function getById($id)
	{
		return $this->model->findOrFail($id);
	}

	public function update($id, Array $inputs)
	{
		$this->getById($id)->update($inputs);
    }

    public function getByProduittagPaginate($tag, $nb)
    {
        return $this->model->whereHas('produittags', function($q) use ($tag) {
            $q->where('produittags.id', '=', $tag);
        })->paginate($nb);
    }
}