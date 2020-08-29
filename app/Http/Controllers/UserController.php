<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\UserRepository;
use App\Repositories\ImageRepository;
use App\Repositories\RdvRepository;
use App\Repositories\ReservationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userRepository;
    protected $imageRepository;

    protected $nbrPerPage = 15;

    public function __construct(UserRepository $userRepository, ImageRepository $imageRepository, RdvRepository $rdvRepository, ReservationRepository $reservationRepository)
    {
        $this->middleware('auth');
        $this->imageRepository = $imageRepository;
        $this->userRepository = $userRepository;
        $this->rdvRepository = $rdvRepository;
        $this->reservationRepository = $reservationRepository;
    }

    public function index()
    {
        //
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
        $attributes = array(
            'name' => $request->input('name'),
            'prenom' => $request->input('prenom'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'adress' => $request->input('adress')
        );

        if($request->hasFile('image'))
        {
            //if user already has image, delete it
            $image = Auth::user()->image;
            if($image)
            {
                $this->imageRepository->destroy($image->id);
            }
            //store new image
            $name = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path() . '/images/', $name);
            $image = $this->imageRepository->store(array('name' => $name));
            $attributes['image_id'] = $image->id;
        }

        $this->userRepository->update($id, $attributes);

        return redirect('user/'.Auth::user()->id)->withOk("Votre profil a bien été modifié.");
    }

    public function destroy($id)
    {
        $this->userRepository->destroy($id);

        return redirect('user')->withOk("L'utilisateur a bien été supprimé.");
    }

    public function updateSession(Request $request)
    {
        $rdv_id = $request->get('rdv');
        $reservation_id = $request->get('reservation');

        if($rdv_id)
        {
            $rdv = $this->rdvRepository->getById($rdv_id);
            $rdvs = session()->pull('rdvs', array());
            $rdvs[$rdv_id] = $rdv;
            session()->put('rdvs', $rdvs);
        }

        if($reservation_id)
        {
            $reservation = $this->reservationRepository->getById($reservation_id);
            $reservations = session()->pull('reservations', array());
            $reservations[$reservation_id] = $reservation;
            session()->put('reservations', $reservations);
        }

        $response = array(
            'total' => session('rdvs')->count() + session('reservations')->count(),
            'rdvs' => session('rdvs')->count(),
            'reservations' => session('reservations')->count()
        );

        return json_encode($response);
    }
}