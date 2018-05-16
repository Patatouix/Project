<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\AnimalRepository;

use App\Repositories\SpeciesRepository;
use App\Repositories\RaceRepository;
use App\Repositories\SportRepository;
use App\Repositories\FoodRepository;
use App\Repositories\EnvironmentRepository;

use App\Http\Requests\AnimalCreateRequest;
use App\Http\Requests\AnimalUpdateRequest;

use Illuminate\Support\Facades\Auth;

class AnimalController extends Controller
{

    protected $animalRepository;
    protected $speciesRepository;
    protected $raceRepository;
    protected $foodRepository;
    protected $sportRepository;
    protected $environmentRepository;

    protected $nbrPerPage = 10;

    public function __construct(AnimalRepository $animalRepository, SpeciesRepository $speciesRepository, RaceRepository $raceRepository, SportRepository $sportRepository, FoodRepository $foodRepository, EnvironmentRepository $environmentRepository)
    {
        $this->middleware('auth');

        $this->animalRepository = $animalRepository;
        $this->speciesRepository = $speciesRepository;
        $this->raceRepository = $raceRepository;
        $this->foodRepository = $foodRepository;
        $this->sportRepository = $sportRepository;
        $this->environmentRepository = $environmentRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->admin) {
            $animals = $this->animalRepository->getAllPaginate($this->nbrPerPage);
            $links = $animals->render();
            return view('animal.index', compact('animals', 'links'));
        }
        else {
            $animals = $this->animalRepository->getAllByUserPaginate(Auth::user()->id, $this->nbrPerPage);
            $links = $animals->render();
            return view('animal.index', compact('animals', 'links'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $data = $this->getFormAttributes();
        return view('animal.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnimalCreateRequest $request)
    {
        $this->setSterilization($request);
        $request->merge(['user_id' => Auth::user()->id]);

        $animal = $this->animalRepository->store($request->all());

        return redirect('animal')->withOk("L'animal " . $animal->name . " a été créé.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $animal = $this->animalRepository->getById($id);

        return view('animal.show', compact('animal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $animal = $this->animalRepository->getById($id);
        $data = $this->getFormAttributes();
        return view('animal.edit', compact('data', 'animal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AnimalUpdateRequest $request, $id)
    {
        $this->setSterilization($request);
        $this->animalRepository->update($id, $request->all());

        return redirect('animal')->withOk("L'animal " . $request->input('name') . " a été modifié.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->animalRepository->destroy($id);

        return redirect('animal')->withOk("L'animal a été supprimé.");
    }

    private function setSterilization($request)
    {
        if(!$request->has('sterilization'))
        {
            $request->merge(['sterilization' => 0]);
        }       
    }

    private function getFormAttributes()
    {
        $allSpecies = $this->speciesRepository->getAll();
        $selectSpe = [];
        foreach($allSpecies as $species){
            $selectSpe[$species->id] = $species->name;
        }
        $races = $this->raceRepository->getAll();
        $selectR = [];
        foreach($races as $race){
            $selectR[$race->id] = $race->name;
        }
        $foods = $this->foodRepository->getAll();
        $selectF = [];
        foreach($foods as $food){
            $selectF[$food->id] = $food->name;
        }
        $sports = $this->sportRepository->getAll();
        $selectSpo = [];
        foreach($sports as $sport){
            $selectSpo[$sport->id] = $sport->name;
        }
        $environments = $this->environmentRepository->getAll();
        $selectE = [];
        foreach($environments as $environment){
            $selectE[$environment->id] = $environment->name;
        }

        return compact('selectSpe', 'selectR', 'selectF', 'selectSpo', 'selectE');
    }
}
