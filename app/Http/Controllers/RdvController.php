<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\RdvRepository;
use App\Repositories\VetRepository;
use App\Http\Requests\RdvCreateRequest;
use App\Http\Requests\RdvUpdateRequest;
use App\Http\Requests\RdvStatusRequest;
use Illuminate\Support\Facades\Auth;

class RdvController extends Controller
{

    protected $rdvRepository;
    protected $vetRepository;

    protected $nbrPerPage = 10;

    public function __construct(RdvRepository $rdvRepository, VetRepository $vetRepository)
    {
        $this->middleware('auth');
        $this->rdvRepository = $rdvRepository;
        $this->vetRepository = $vetRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rdvs = $this->rdvRepository->getAllByUserPaginate(Auth::user()->id, $this->nbrPerPage);
        $links = $rdvs->render();
        $select = $this->getStatusIdsForSelect();

        return view('rdv.index', compact('rdvs', 'links', 'select'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $selectData = $this->getSelectData();

        return view('rdv.create')->with('selectData', $selectData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RdvCreateRequest $request)
    {
        $rdv = $this->rdvRepository->store(array('request' => $request->input('request'), 'user_id' => Auth::user()->id,
            'vet_id' => $request->input('vet_id')));

        $rdv->animals()->attach($request->input('animal_id'));

        broadcast(new \App\Events\NotificationAdminEvent('Nouvelle demande de rendez-vous', $rdv->id, null));

        return redirect('rdv')->withOk("La demande de RDV #". $rdv->id." a été créée.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $selectData = $this->getSelectData();
        $rdv = $this->rdvRepository->getById($id);

        return view('rdv.edit', compact('rdv', 'selectData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RdvUpdateRequest $request, $id)
    {
        $request->merge(['status' => 'En attente']);
        $this->rdvRepository->update($id, array('request' => $request->input('request'), 'response' => $request->input('response'),
            'status' => 'En attente', 'user_id' => Auth::user()->id, 'vet_id' => $request->input('vet_id')));
        $rdv = $this->rdvRepository->getById($id);
        $rdv->animals()->sync($request->input('animal_id'));

        $rdvs = session()->pull('rdvs', array());
        unset($rdvs[$id]);
        session()->put('rdvs', $rdvs);

        broadcast(new \App\Events\NotificationAdminEvent('Nouvelle demande de rendez-vous', $rdv->id, null));

        return redirect('rdv')->withOk("Le rdv # " . $id . " a été modifié.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->rdvRepository->destroy($id);

        return redirect('rdv')->withOk("La demande de rdv a été supprimée.");
    }

    public function confirm($id)
    {
        $this->rdvRepository->update($id, ['status' => 'Confirmé']);

        $rdvs = session()->pull('rdvs', array());
        unset($rdvs[$id]);
        session()->put('rdvs', $rdvs);

        broadcast(new \App\Events\NotificationAdminEvent('Demande de rdv confirmée', $id, null));

        return redirect('rdv')->withOk("Vous avez confirmé la proposition de rdv #" . $id);
    }

    public function archive($id)
    {
        $this->rdvRepository->update($id, ['status' => 'Archivé']);

        return redirect('rdv')->withOk("Vous avez archivé la demande de rdv #" . $id);
    }

    public function getSelectData()
    {
        $vets = $this->vetRepository->getAll();
        $vetsSelect = [];
        foreach($vets as $vet){
            $vetsSelect[$vet->id] = $vet->name;
        }

        $animals = Auth::user()->animals;
        $animalsSelect = [];
        foreach($animals as $animal){
            $animalsSelect[$animal->id] = $animal->name;
        }

        $selectData = array(
            'vetsSelect' => $vetsSelect,
            'animalsSelect' => $animalsSelect,
        );

        return $selectData;
    }

    public function redirectRdvStatus(RdvStatusRequest $request)
    {
        $status_id  = $request->input('status_id');

        return redirect('rdv/status/' . $status_id);
    }

    public function indexRdvStatus($status_id)
    {
        $status = $this->getStatusFromId($status_id);
        $rdvs = $this->rdvRepository->getByUserByStatusPaginate(Auth::user()->id, $status, $this->nbrPerPage);
        $links = $rdvs->render();
        $select = $this->getStatusIdsForSelect();

        return view('rdv.index', compact('rdvs', 'links', 'select', 'status_id'));
    }

    public function getStatusIdsForSelect()
    {
        $select = array(
            1 => 'En attente',
            2 => 'Traité',
            3 => 'Confirmé',
            4 => 'Archivé'
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
                $status = 'Traité';
                break;
            case 3:
                $status = 'Confirmé';
                break;
            case 4:
                $status = 'Archivé';
                break;
        }

        return $status;
    }
}
