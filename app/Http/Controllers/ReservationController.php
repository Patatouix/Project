<?php

namespace App\Http\Controllers;

use App\Repositories\ProduitRepository;
use App\Repositories\ReservationRepository;

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
        $this->middleware('auth');
        $this->produitRepository = $produitRepository;
        $this->reservationRepository = $reservationRepository;
    }

    public function index()
    {
        $reservations = $this->reservationRepository->getAllByUserPaginate(Auth::user()->id, $this->nbrPerPage);
        $links = $reservations->render();
        $select = $this->getStatusIdsForSelect();

        return view('reservation.index', compact('reservations', 'links', 'select'));
    }

    public function create($id)
    {
        $produit = $this->produitRepository->getById($id);
        return view('reservation.create', compact('produit'));
    }

    public function edit($id)
    {
        $reservation = $this->reservationRepository->getById($id);

        return view('reservation.edit', compact('reservation'));
    }

    public function show($id)
    {
        $produit = $this->produitRepository->getById($id);

        return view('produit.show', compact('produit'));
    }

    public function store($id)
    {
        $userReservationActive = $this->reservationRepository->getByUser(Auth::user()->id);
        if(!$userReservationActive->count())
        {
            $reservation = $this->reservationRepository->store(array('user_id' => Auth::user()->id));
            $reservation->produits()->attach($id);

            broadcast(new \App\Events\NotificationAdminEvent('Nouvelle réservation', null, $reservation->id));

            $message = "La réservation #" . $reservation->id . " a été créée.";
            return redirect('reservation')->withOk($message);
        }
        else
        {
            $message = "Erreur : la réservation n'a pas être créée, car vous avez déjà une réservation en cours.";
            return redirect('reservation')->withError($message);
        }
    }

    public function destroy($id)
    {
        $this->reservationRepository->destroy($id);

        return redirect('reservation')->withOk("La réservation a été supprimée.");
    }

    public function update(ReservationUpdateRequest $request, $id)
    {
        $this->reservationRepository->update($id, $request->all());
        session(['notifreservation' => session('notifreservation') - 1]);

        return redirect('reservation')->withOk("La réservation # " . $id . " a été traitée.");
    }

    public function archive($id)
    {
        $this->reservationRepository->archive($id);

        return redirect('reservation')->withOk("Vous avez archivé la demande de réservation #" . $id);
    }

    public function redirectReservationStatus(ReservationStatusRequest $request)
    {
        $status_id  = $request->input('status_id');

        return redirect('reservation/status/' . $status_id);
    }

    public function indexReservationStatus($status_id)
    {
        $status = $this->getStatusFromId($status_id);
        $reservations = $this->reservationRepository->getByUserByStatusPaginate(Auth::user()->id, $status, $this->nbrPerPage);
        $links = $reservations->render();
        $select = $this->getStatusIdsForSelect();

        return view('reservation.index', compact('reservations', 'links', 'select', 'status_id'));
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