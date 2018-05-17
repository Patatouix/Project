<?php

namespace App\Repositories;

use App\Article;

class ArticleRepository {

    protected $article;

    public function __construct(Article $article)
	{
		$this->article = $article;
	}

	private function getAll()
	{
		return $this->article->orderBy('articles.price');		
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