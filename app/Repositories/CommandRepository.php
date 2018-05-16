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
		return $this->command->where('id_user', $id)->orderBy('commands.created_at', 'desc');		
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
		return $this->article->where('id_tag', $tag)->orderBy('articles.price')->paginate($n);	
	}

	public function store($id_user, $id_article)
	{
		return $this->command->create(array('id_user' => $id_user, 'id_article' => $id_article));
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