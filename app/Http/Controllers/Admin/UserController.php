<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\RdvRepository;
use App\Repositories\ReservationRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userRepository;
    protected $rdvRepository;
    protected $reservationRepository;

    protected $nbrPerPage = 15;

    public function __construct(UserRepository $userRepository, RdvRepository $rdvRepository, ReservationRepository $reservationRepository)
    {
        $this->middleware('admin');
        $this->userRepository = $userRepository;
        $this->rdvRepository = $rdvRepository;
        $this->reservationRepository = $reservationRepository;
    }

    public function index()
    {
        $users = $this->userRepository->getNonAdmin()->orderBy('name')->paginate($this->nbrPerPage);
        $links = $users->render();
        return view('admin.user.index', compact('users', 'links'));
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
        return view('admin.user.show',  compact('user'));
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

        return redirect('user/'.Auth::user()->id)->withOk("Votre profil a bien été modifié.");
    }

    public function destroy($id)
    {
        $this->userRepository->destroy($id);

        return redirect('user')->withOk("L'utilisateur a bien été supprimé.");
    }

    private function setAdmin($request)
    {
        if(!$request->has('admin'))
        {
            $request->merge(['admin' => 0]);
        }
    }

    public function updateSession(Request $request)
    {
        $rdv_id = $request->get('rdv');
        $reservation_id = $request->get('reservation');

        if($rdv_id)
        {
            $rdv = $this->rdvRepository->getById($rdv_id);
            if($rdv->status == 'En attente')
            {
                $rdvsAttente = session()->pull('rdvsAttente', array());
                $rdvsAttente[$rdv_id] = $rdv;
                session()->put('rdvsAttente', $rdvsAttente);
            }
            else
            {
                $rdvsConfirme = session()->pull('rdvsConfirme', array());
                $rdvsConfirme[$rdv_id] = $rdv;
                session()->put('rdvsConfirme', $rdvsConfirme);
            }
        }

        if($reservation_id)
        {
            $reservation = $this->reservationRepository->getById($reservation_id);
            $reservations = session()->pull('reservations', array());
            $reservations[$reservation_id] = $reservation;
            session()->put('reservations', $reservations);
        }

        $response = array(
            'total' => session('rdvsAttente')->count() + session('rdvsConfirme')->count() + session('reservations')->count(),
            'rdvsAttente' => session('rdvsAttente')->count(),
            'rdvsConfirme' => session('rdvsConfirme')->count(),
            'reservations' => session('reservations')->count()
        );

        return json_encode($response);
    }
}