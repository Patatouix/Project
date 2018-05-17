<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;

use App\Repositories\UserRepository;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    protected $userRepository;

    protected $nbrPerPage = 10;

    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('auth');
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        if(Auth::user()->admin) {
            $users = $this->userRepository->getPaginate($this->nbrPerPage);
            $links = $users->render();
            return view('user.index', compact('users', 'links'));
        }
        else {

            return redirect()->route('user.show', ['id' => Auth::user()->id]);
        }
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(UserCreateRequest $request)
    {
        $this->setAdmin($request);

        $user = $this->userRepository->store($request->all());

        return redirect('user')->withOk("L'utilisateur " . $user->name . " a été créé.");
    }

    public function show($id)
    {
        $user = $this->userRepository->getById($id);

        return view('user.show',  compact('user'));
    }

    public function edit($id)
    {
        $user = $this->userRepository->getById($id);

        return view('user.edit',  compact('user'));
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $this->setAdmin($request);

        $this->userRepository->update($id, $request->all());
        
        return redirect('user')->withOk("L'utilisateur " . $request->input('name') . " a été modifié.");
    }

    public function destroy($id)
    {
        $this->userRepository->destroy($id);

        return redirect()->back();
    }

    private function setAdmin($request)
    {
        if(!$request->has('admin'))
        {
            $request->merge(['admin' => 0]);
        }       
    }

}