<?php

namespace App\Repositories;

use App\Command;

class CommandRepository {

    protected $command;

    public function __construct(Command $command)
	{
		$this->command = $command;
	}

	private function getAllbyUser($id)
	{
		return $this->command->where('user_id', $id)->orderBy('commands.created_at', 'desc');
		dd(0);
	}

	private function getAll()
	{
		return $this->command->orderBy('commands.status', 'asc');		
	}

	public function getAllByUserPaginate($id, $n)
	{
		return $this->getAllByUser($id)->paginate($n);
	}

	public function getAllPaginate($n)
	{
		return $this->getAll()->paginate($n);
	}

	public function getByTagPaginate($tag, $n)
	{
		return $this->article->where('tag_id', $tag)->orderBy('articles.price')->paginate($n);	
	}

	public function store($user_id, $article_id)
	{
		return $this->command->create(array('user_id' => $user_id, 'article_id' => $article_id));
	}

	public function destroy($id)
	{
		$command = $this->command->findOrFail($id);
		$command->delete();
	}

	public function getById($id)
	{
		return $this->command->findOrFail($id);
	}

	public function update($id, Array $inputs)
	{
		$command = $this->getById($id);
		$command->update($inputs);
		$command->status ='Validée';
		$command->save();
	}

}