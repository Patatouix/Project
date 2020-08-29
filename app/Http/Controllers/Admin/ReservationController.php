<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\ProduitRepository;
use App\Repositories\ReservationRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationUpdateRequest;
use App\Http\Requests\ReservationStatusRequest;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{

    protected $produitRepository;
    protected $tagRepository;
    protected $reservationRepository;

    protected $nbrPerPage = 10;

    public function __construct(ProduitRepository $produitRepository, ReservationRepository $reservationRepository)
    {
        $this->middleware('admin');
        $this->produitRepository = $produitRepository;
        $this->reservationRepository = $reservationRepository;
    }

    public function index()
    {
        $reservations = $this->reservationRepository->getAllPaginate($this->nbrPerPage);
        $links = $reservations->render();
        $select = $this->getStatusIdsForSelect();

        return view('admin.reservation.index', compact('reservations', 'links', 'select'));
    }

    public function create($id)
    {
        $reservation = $this->reservationRepository->getById($id);
        return view('admin.reservation.create', compact('produit'));
    }

    public function edit($id)
    {
        $reservation = $this->reservationRepository->getById($id);
        return view('admin.reservation.edit', compact('reservation'));
    }

    public function show($id)
    {
        $produit = $this->produitRepository->getById($id);

        return view('admin.produit.show', compact('produit'));
    }

    public function store($id)
    {
        $reservation = $this->reservationRepository->store(array('status_id' => Auth::status()->id, 'produit_id' => $id));
        session(['notifreservation' => session('notifreservation') + 1]);

        return redirect('admin/reservation')->withOk("La réservation " . $reservation->id . " a été créée.");
    }

    public function destroy($id)
    {
        $this->reservationRepository->destroy($id);

        return redirect('reservation')->withOk("La réservation a été supprimée.");
    }

    public function update(ReservationUpdateRequest $request, $id)
    {
        $this->reservationRepository->update($id, array('takeout' => $request->input('takeout')));

        $reservations = session()->pull('reservations', array());
        unset($reservations[$id]);
        session()->put('reservations', $reservations);

        $reservation = $this->reservationRepository->getById($id);
        broadcast(new \App\Events\NotificationUserEvent($reservation->user, 'Demande de réservation traitée', null, $id));

        return redirect('admin/reservation')->withOk("La réservation # " . $id . " a été traitée.");
    }

    public function archive($id)
    {
        $this->reservationRepository->archive($id);
        return redirect('admin/reservation')->withOk("Vous avez archivé la demande de réservation #" . $id);
    }

    public function redirectReservationStatus(ReservationStatusRequest $request)
    {
        $status_id  = $request->input('status_id');

        return redirect('admin/reservation/status/' . $status_id);
    }

    public function indexReservationStatus($status_id)
    {
        $status = $this->getStatusFromId($status_id);
        $reservations = $this->reservationRepository->getAllByStatusPaginate($status, $this->nbrPerPage);
        $links = $reservations->render();
        $select = $this->getStatusIdsForSelect();

        return view('admin.reservation.index', compact('reservations', 'links', 'select', 'status_id'));
    }

    public function getStatusIdsForSelect()
    {
        $select = array(
            1 => 'En attente',
            2 => 'Validée',
            3 => 'Archivée'
        );
        return $select;
    }

    public function getStatusFromId($id)
    {
        switch($id)
        {
            case 1:
                $status = 'En attente';
                break;
            case 2:
                $status = 'Validée';
                break;
            case 3:
                $status = 'Archivée';
                break;
        }

        return $status;
    }
}