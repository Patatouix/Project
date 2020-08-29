<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repositories\RdvRepository;
use App\Repositories\VetRepository;
use App\Http\Requests\RdvCreateRequest;
use App\Http\Requests\RdvUpdateRequest;
use App\Http\Requests\RdvStatusRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class RdvController extends Controller
{

    protected $rdvRepository;
    protected $vetRepository;

    protected $nbrPerPage = 10;

    public function __construct(RdvRepository $rdvRepository, VetRepository $vetRepository)
    {
        $this->middleware('admin');
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
        $rdvs = $this->rdvRepository->getAllPaginate($this->nbrPerPage);
        $links = $rdvs->render();
        $select = $this->getStatusIdsForSelect();

        return view('admin.rdv.index', compact('rdvs', 'links', 'select'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vets = $this->vetRepository->getAll();
        $selectV = [];
        foreach($vets as $vet){
            $selectV[$vet->id] = $vet->name;
        }

        $animals = Auth::user()->animals;
        $selectA = [];
        foreach($animals as $animal){
            $selectA[$animal->id] = $animal->name;
        }

        return view('admin.rdv.create', compact('selectV', 'selectA'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RdvCreateRequest $request)
    {
        //
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
        $vets = $this->vetRepository->getAll();
        $vetsSelect = [];
        foreach($vets as $vet){
            $vetsSelect[$vet->id] = $vet->name;
        }

        $rdv = $this->rdvRepository->getById($id);
        $animals = $rdv->user->animals;
        $animalsSelect = [];
        foreach($animals as $animal){
            $animalsSelect[$animal->id] = $animal->name;
        }

        $selectData = array(
            'vetsSelect' => $vetsSelect,
            'animalsSelect' => $animalsSelect,
        );

        return view('admin.rdv.edit', compact('rdv', $selectData));
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
        $request->merge(['status' => 'Traité']);
        $this->rdvRepository->update($id, $request->all());

        $rdvsAttente = session()->pull('rdvsAttente', array());
        unset($rdvsAttente[$id]);
        session()->put('rdvsAttente', $rdvsAttente);

        $rdv = $this->rdvRepository->getById($id);
        broadcast(new \App\Events\NotificationUserEvent($rdv->user, 'Demande de rdv traitée', $id, null));

        return redirect('admin/rdv')->withOk("Le rdv # " . $id . " a été traité.");
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
        return redirect('admin/rdv')->withOk("La demande de rdv a été supprimée.");
    }

    public function confirm($id)
    {
        $this->rdvRepository->update($id, ['status' => 'Confirmé']);
        session(['notifRdv' => session('notifRdv') - 1]);

        return redirect('admin/rdv')->withOk("Vous avez confirmé la proposition de rdv #" . $id);
    }

    public function archive($id)
    {
        $this->rdvRepository->update($id, ['status' => 'Archivé']);
        return redirect('admin/rdv')->withOk("Vous avez archivé la demande de rdv #" . $id);
    }

    public function redirectRdvStatus(RdvStatusRequest $request)
    {
        $status_id  = $request->input('status_id');

        return redirect('admin/rdv/status/' . $status_id);
    }

    public function indexRdvStatus($status_id)
    {
        $status = $this->getStatusFromId($status_id);
        $rdvs = $this->rdvRepository->getAllByStatusPaginate($status, $this->nbrPerPage);
        $links = $rdvs->render();
        $select = $this->getStatusIdsForSelect();

        return view('admin.rdv.index', compact('rdvs', 'links', 'select', 'status_id'));
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
