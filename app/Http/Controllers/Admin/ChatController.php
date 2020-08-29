<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Events\NewMessageEvent;
use App\Http\Controllers\Controller;

class ChatController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
    }

    public function index()
    {
        return view('admin.chat.index');
    }

    public function sendMessage(Request $request)
    {
        $data = ['message' => $request->input('message'), 'user' => $request->input('user'), 'admin' => $request->input('admin')];
        broadcast(new NewMessageEvent($data));

        return $data;
	}
}
