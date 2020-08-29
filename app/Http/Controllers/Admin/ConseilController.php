<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ConseilRepository ;
use App\Repositories\ConseiltagRepository;
use App\Repositories\AgeRepository;
use App\Repositories\EnvironmentRepository;
use App\Repositories\EspeceRepository;
use App\Repositories\FoodRepository;
use App\Repositories\GenderRepository;
use App\Repositories\RaceRepository;
use App\Repositories\SportRepository;
use App\Repositories\SterilizationRepository;
use App\Repositories\WeightRepository;
use App\Http\Requests\ConseilCreateRequest;

class ConseilController extends Controller
{
    protected $nbrPerPage = 15;
    protected $conseilRepository;
    protected $conseiltagRepository;
    protected $ageRepository;
    protected $environmentRepository;
    protected $especeRepository;
    protected $foodRepository;
    protected $genderRepository;
    protected $raceRepository;
    protected $sportRepository;
    protected $sterilizationRepository;
    protected $weightRepository;

    public function __construct(ConseilRepository $conseilRepository, ConseiltagRepository $conseiltagRepository,
        EnvironmentRepository $environmentRepository, EspeceRepository $especeRepository, FoodRepository $foodRepository,
        GenderRepository $genderRepository, RaceRepository $raceRepository, SportRepository $sportRepository,
        SterilizationRepository $sterilizationRepository, WeightRepository $weightRepository, AgeRepository $ageRepository)
    {
        $this->middleware('admin');
        $this->conseilRepository = $conseilRepository;
        $this->conseiltagRepository = $conseiltagRepository;
        $this->ageRepository = $ageRepository;
        $this->environmentRepository = $environmentRepository;
        $this->especeRepository = $especeRepository;
        $this->foodRepository = $foodRepository;
        $this->genderRepository = $genderRepository;
        $this->raceRepository = $raceRepository;
        $this->sportRepository = $sportRepository;
        $this->sterilizationRepository = $sterilizationRepository;
        $this->weightRepository = $weightRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conseils = $this->conseilRepository->getAllPaginate($this->nbrPerPage);
        $links = $conseils->render();
        return view('admin.conseil.index', compact('conseils', 'links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->getFormAttributes();
        return view('admin.conseil.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConseilCreateRequest $request)
    {
        $conseil = $this->conseilRepository->store(array('title' => $request->input('title'), 'text' => $request->input('text')));
        $conseil->conseiltags()->attach($request->input('conseiltag_id'));
        $conseil->ages()->attach($request->input('age_id'));
        $conseil->environments()->attach($request->input('environment_id'));
        $conseil->especes()->attach($request->input('espece_id'));
        $conseil->foods()->attach($request->input('food_id'));
        $conseil->genders()->attach($request->input('gender_id'));
        $conseil->races()->attach($request->input('race_id'));
        $conseil->sports()->attach($request->input('sport_id'));
        $conseil->sterilizations()->attach($request->input('sterilization_id'));
        $conseil->weights()->attach($request->input('weight_id'));

        return redirect('admin/conseil')->withOk('Le conseil "' . $conseil->title . '" a été créé.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $conseil = $this->conseilRepository->getById($id);
        return view('admin.conseil.show', compact('conseil'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $conseil = $this->conseilRepository->getById($id);
        $data = $this->getFormAttributes();
        return view('admin.conseil.edit', compact('data', 'conseil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->conseilRepository->update($id, array('title' => $request->input('title'), 'text' => $request->input('text')));

        $conseil = $this->conseilRepository->getById($id);
        $conseil->conseiltags()->sync($request->input('conseiltag_id'));
        $conseil->ages()->sync($request->input('age_id'));
        $conseil->environments()->sync($request->input('environment_id'));
        $conseil->especes()->sync($request->input('espece_id'));
        $conseil->foods()->sync($request->input('food_id'));
        $conseil->genders()->sync($request->input('gender_id'));
        $conseil->races()->sync($request->input('race_id'));
        $conseil->sports()->sync($request->input('sport_id'));
        $conseil->sterilizations()->sync($request->input('sterilization_id'));
        $conseil->weights()->sync($request->input('weight_id'));

        return redirect('admin/conseil/' . $id)->withOk("Le conseil " . $request->input('title') . " a été modifié.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function parametres()
    {
        $conseiltags = $this->conseiltagRepository->getAll();
        $ages = $this->ageRepository->getAll();
        $environments = $this->environmentRepository->getAll();
        $especes = $this->especeRepository->getAll();
        $foods = $this->foodRepository->getAll();
        $genders = $this->genderRepository->getAll();
        $races = $this->raceRepository->getAll();
        $sports = $this->sportRepository->getAll();
        $sterilizations = $this->sterilizationRepository->getAll();
        $weights = $this->weightRepository->getAll();

        $especesSelect = array();
        foreach($especes as $espece)
        {
            $especesSelect[$espece->id] = $espece->name;
        }

        return view('admin.conseil.parametres', compact(
            'conseiltags', 'ages', 'environments', 'especes',
            'foods', 'genders', 'races', 'sports',
            'sterilizations', 'weights', 'especesSelect'));
    }

    public function conseiltagStore(Request $request)
    {
        $conseiltag = $this->conseiltagRepository->store(array('name' => $request->input('name')));

        return redirect('admin/parametres')->withOk("La catégorie a bien été créée !");
    }

    public function ageStore(Request $request)
    {
        $age = $this->ageRepository->store(array('name' => $request->input('name')));

        return redirect('admin/parametres')->withOk("L'âge a bien été créé !");
    }

    public function environmentStore(Request $request)
    {
        $environment = $this->environmentRepository->store(array('name' => $request->input('name')));

        return redirect('admin/parametres')->withOk("L'environnment a bien été créé !");
    }

    public function especeStore(Request $request)
    {
        $espece = $this->especeRepository->store(array('name' => $request->input('name')));

        return redirect('admin/parametres')->withOk("L'espèce a bien été créée !");
    }

    public function foodStore(Request $request)
    {
        $food = $this->foodRepository->store(array('name' => $request->input('name')));

        return redirect('admin/parametres')->withOk("La nourriture a bien été créée !");
    }

    public function genderStore(Request $request)
    {
        $gender = $this->genderRepository->store(array('name' => $request->input('name')));

        return redirect('admin/parametres')->withOk("Le sexe a bien été créé !");
    }

    public function raceStore(Request $request)
    {
        $race = $this->raceRepository->store(array('name' => $request->input('name'), 'espece_id' => $request->input('espece_id')));

        return redirect('admin/parametres')->withOk("La race a bien été créée !");
    }

    public function sportStore(Request $request)
    {
        $sport = $this->sportRepository->store(array('name' => $request->input('name')));

        return redirect('admin/parametres')->withOk("Le sport a bien été créé !");
    }

    public function sterilizationStore(Request $request)
    {
        $sterilization = $this->sterilizationRepository->store(array('name' => $request->input('name')));

        return redirect('admin/parametres')->withOk("La stérilisation a bien été créée !");
    }

    public function weightStore(Request $request)
    {
        $weight = $this->weightRepository->store(array('name' => $request->input('name')));

        return redirect('admin/parametres')->withOk("Le poids a bien été créé !");
    }


    private function getFormAttributes()
    {
        $conseiltags = $this->conseiltagRepository->getAll();
        $conseiltagsSelect = [];
        foreach($conseiltags as $conseiltag){
            $conseiltagsSelect[$conseiltag->id] = $conseiltag->name;
        }

        $ages = $this->ageRepository->getAll();
        $agesSelect = [];
        foreach($ages as $age){
            $agesSelect[$age->id] = $age->name;
        }

        $environments = $this->environmentRepository->getAll();
        $environmentsSelect = [];
        foreach($environments as $environment){
            $environmentsSelect[$environment->id] = $environment->name;
        }

        $especes = $this->especeRepository->getAll();
        $especesSelect = [];
        foreach($especes as $espece){
            $especesSelect[$espece->id] = $espece->name;
        }

        $foods = $this->foodRepository->getAll();
        $foodsSelect = [];
        foreach($foods as $food){
            $foodsSelect[$food->id] = $food->name;
        }

        $genders = $this->genderRepository->getAll();
        $gendersSelect = [];
        foreach($genders as $gender){
            $gendersSelect[$gender->id] = $gender->name;
        }

        $races = $this->raceRepository->getAll();
        $racesSelect = [];
        foreach($races as $race){
            $racesSelect[$race->id] = $race->name;
        }

        $sports = $this->sportRepository->getAll();
        $sportsSelect = [];
        foreach($sports as $sport){
            $sportsSelect[$sport->id] = $sport->name;
        }

        $sterilizations = $this->sterilizationRepository->getAll();
        $sterilizationsSelect = [];
        foreach($sterilizations as $sterilization){
            $sterilizationsSelect[$sterilization->id] = $sterilization->name;
        }

        $weights = $this->weightRepository->getAll();
        $weightsSelect = [];
        foreach($weights as $weight){
            $weightsSelect[$weight->id] = $weight->name;
        }

        $selectData = array(
            'conseiltagsSelect' => $conseiltagsSelect,
            'agesSelect' => $agesSelect,
            'environmentsSelect' => $environmentsSelect,
            'especesSelect' => $especesSelect,
            'foodsSelect' => $foodsSelect,
            'gendersSelect' => $gendersSelect,
            'racesSelect' => $racesSelect,
            'sportsSelect' => $sportsSelect,
            'sterilizationsSelect' => $sterilizationsSelect,
            'weightsSelect' => $weightsSelect
        );

        foreach($selectData as &$select)
        {
            $select[0] = 'All';
            ksort($select);
        }

        return $selectData;
    }
}
