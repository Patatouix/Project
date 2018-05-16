<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\RdvRepository;
use App\Repositories\VetRepository;
use App\Http\Requests\RdvCreateRequest;
use App\Http\Requests\RdvUpdateRequest;
use Illuminate\Support\Facades\Auth;

class RdvController extends Controller
{

    protected $rdvRepository;
    protected $vetRepository;

    protected $nbrPerPage = 5;

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
        if(Auth::user()->admin) {
            $rdvs = $this->rdvRepository->getAllPaginate($this->nbrPerPage);
            $links = $rdvs->render();
            return view('rdv.index', compact('rdvs', 'links'));
        }
        else {
            $rdvs = $this->rdvRepository->getAllByUserPaginate(Auth::user()->id, $this->nbrPerPage);
            $links = $rdvs->render();
            return view('rdv.index', compact('rdvs', 'links'));
        }
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

        return view('rdv.create', compact('selectV', 'selectA'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RdvCreateRequest $request)
    {
        $request->merge(['user_id' => Auth::user()->id]);
        $user = $this->rdvRepository->store($request->all());

        return redirect('rdv')->withOk("La demande de RDV a été créée.");
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
        $rdv = $this->rdvRepository->getById($id);

        return view('rdv.edit', compact('rdv'));
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
        if(Auth::user()->admin) {
            $request->merge(['status' => 'Traité']);
            $this->rdvRepository->update($id, $request->all());
            return redirect('rdv')->withOk("Le rdv # " . $id . " a été traité.");
        }
        else {
            $request->merge(['status' => 'En attente']);
            $this->rdvRepository->update($id, $request->all());
            return redirect('rdv')->withOk("Le rdv # " . $id . " a été modifié.");
        }

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
        return redirect('rdv')->withOk("Vous avez confirmé la proposition de rdv #" . $id);
    }
}
