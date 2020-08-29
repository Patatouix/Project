<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $this->middleware('admin');
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
        // create notifications for admin
        $reservations = $this->reservationRepository->getWhere('status', 'En attente')->keyBy('id');
        $rdvs_attente = $this->rdvRepository->getWhere('status', 'En attente')->keyBy('id');
        $rdvs_confirme = $this->rdvRepository->getWhere('status', 'Confirmé')->keyBy('id');

        session(['reservations' => $reservations]);
        session(['rdvsAttente' => $rdvs_attente]);
        session(['rdvsConfirme' => $rdvs_confirme]);

        // get last registrations
        $rdvs = $this->rdvRepository->getLastRdvsForAdmin();
        $reservations = $this->reservationRepository->getLastReservationsForAdmin();
        $animals = $this->animalRepository->getLastRegisteredAnimals();
        $users = $this->userRepository->getLastRegisteredUsers();

        return view('admin.home', compact('user', 'rdvs', 'reservations', 'animals', 'users'));
    }

    // reservations notifications
    public function getNotifReservation()
    {
        return $this->reservationRepository->getNotifReservation();
    }

    // rdvs notifications
    public function getNotifRdv()
    {
        return $this->rdvRepository->getNotifRdv();
    }
}


