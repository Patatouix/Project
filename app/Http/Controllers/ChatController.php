<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\NewMessageEvent;

class ChatController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
    }

    public function index()
    {
        return view('chat.index');
    }

    public function sendMessage(Request $request)
    {
        $data = ['message' => $request->input('message'), 'user' => $request->input('user')];
        broadcast(new NewMessageEvent($data));

        return $data;
	}
}
