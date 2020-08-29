<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\RdvRepository;
use App\Repositories\ReservationRepository;
use App\Repositories\UserRepository;
use App\Repositories\AnimalRepository;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    protected $reservationRepository;
    protected $rdvRepository;
    protected $userRepository;
    protected $animalRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository, ReservationRepository $reservationRepository, RdvRepository $rdvRepository, AnimalRepository $animalRepository)
    {
        $this->middleware('auth');
        $this->rdvRepository = $rdvRepository;
        $this->reservationRepository = $reservationRepository;
        $this->userRepository = $userRepository;
        $this->animalRepository = $animalRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // create notifications for user
         // create notifications for admin
        $reservations = $this->reservationRepository->getWhere('status', 'Validée')->keyBy('id');
        $rdvs = $this->rdvRepository->getWhere('status', 'Traité')->keyBy('id');

        session(['reservations' => $reservations]);
        session(['rdvs' => $rdvs]);

        // get user information
        $user = Auth::user();
        $rdvs = $this->rdvRepository->getLastRdvsForUser($user->id);
        $reservations = $this->reservationRepository->getLastReservationsForUser($user->id);
        $animals = $this->animalRepository->getAll();

        return view('home', compact('user', 'rdvs', 'reservations', 'animals'));
    }
}


