<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AnimalRepository;
use App\Repositories\UserRepository;
use App\Repositories\AgeRepository;
use App\Repositories\WeightRepository;
use App\Repositories\GenderRepository;
use App\Repositories\SterilizationRepository;
use App\Repositories\EspeceRepository;
use App\Repositories\RaceRepository;
use App\Repositories\SportRepository;
use App\Repositories\FoodRepository;
use App\Repositories\ConseilRepository;
use App\Repositories\ImageRepository;
use App\Repositories\EnvironmentRepository;
use App\Http\Requests\AnimalCreateRequest;
use App\Http\Requests\AnimalUpdateRequest;
use Illuminate\Support\Facades\Auth;

class AnimalController extends Controller
{
    protected $animalRepository;
    protected $userRepository;
    protected $ageRepository;
    protected $weightRepository;
    protected $genderRepository;
    protected $sterilizationRepository;
    protected $especeRepository;
    protected $raceRepository;
    protected $foodRepository;
    protected $sportRepository;
    protected $conseilRepository;
    protected $environmentRepository;
    protected $imageRepository;

    protected $nbrPerPage = 18;

    public function __construct(AnimalRepository $animalRepository, EspeceRepository $especeRepository,
        RaceRepository $raceRepository, SportRepository $sportRepository, FoodRepository $foodRepository,
        EnvironmentRepository $environmentRepository, ConseilRepository $conseilRepository,
        AgeRepository $ageRepository, WeightRepository $weightRepository, GenderRepository $genderRepository,
        SterilizationRepository $sterilizationRepository, UserRepository $userRepository, ImageRepository $imageRepository)
    {
        $this->middleware('auth');
        $this->animalRepository = $animalRepository;
        $this->userRepository = $userRepository;
        $this->ageRepository = $ageRepository;
        $this->weightRepository = $weightRepository;
        $this->genderRepository = $genderRepository;
        $this->sterilizationRepository = $sterilizationRepository;
        $this->especeRepository = $especeRepository;
        $this->raceRepository = $raceRepository;
        $this->foodRepository = $foodRepository;
        $this->sportRepository = $sportRepository;
        $this->environmentRepository = $environmentRepository;
        $this->conseilRepository = $conseilRepository;
        $this->imageRepository = $imageRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $animals = $this->animalRepository->getAllByUserPaginate(Auth::user()->id, $this->nbrPerPage);
        $links = $animals->render();
        return view('animal.index', compact('animals', 'links'));
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
        $attributes = array(
            'name' => $request->input('name'),
            'user_id' => Auth::user()->id, 'age_id' => $request->input('age_id'),
            'weight_id' => $request->input('weight_id'), 'gender_id' => $request->input('gender_id'),
            'sterilization_id' => $request->input('sterilization_id'), 'espece_id' => $request->input('espece_id'),
            'sport_id' => $request->input('sport_id')
        );

        if($request->hasFile('image'))
        {
            //store new image
            $name = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path() . '/images/', $name);
            $image = $this->imageRepository->store(array('name' => $name));
            $attributes['image_id'] = $image->id;
        }

        $animal = $this->animalRepository->store($attributes);

        $animal->races()->attach($request->input('race_id'));
        $animal->foods()->attach($request->input('food_id'));
        $animal->environments()->attach($request->input('environment_id'));

        return redirect('animal')->withOk($animal->name . " a été ajouté à la liste de vos animaux !");
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
        $conseils = $this->getAnimalConseils($animal);

        return view('animal.show', compact('animal', 'conseils'));
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
        $animal = $this->animalRepository->getById($id);

        $attributes = array(
            'name' => $request->input('name'), 'age_id' => $request->input('age_id'),
            'weight_id' => $request->input('weight_id'), 'gender_id' => $request->input('gender_id'),
            'sterilization_id' => $request->input('sterilization_id'), 'espece_id' => $request->input('espece_id'),
            'sport_id' => $request->input('sport_id')
        );

        if($request->hasFile('image'))
        {
            //if user already has image, delete it
            $image = $animal->image;
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

        $this->animalRepository->update($id, $attributes);

        $animal->races()->sync($request->input('race_id'));
        $animal->foods()->sync($request->input('food_id'));
        $animal->environments()->sync($request->input('environment_id'));

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

        return redirect('animal')->withOk("Le profil a bien été supprimé.");
    }

    private function getFormAttributes()
    {
        $ages = $this->ageRepository->getAll();
        $agesSelect = [];
        foreach($ages as $age){
            $agesSelect[$age->id] = $age->name;
        }
        $weights = $this->weightRepository->getAll();
        $weightsSelect = [];
        foreach($weights as $weight){
            $weightsSelect[$weight->id] = $weight->name;
        }
        $genders = $this->genderRepository->getAll();
        $gendersSelect = [];
        foreach($genders as $gender){
            $gendersSelect[$gender->id] = $gender->name;
        }
        $sterilizations = $this->sterilizationRepository->getAll();
        $sterilizationsSelect = [];
        foreach($sterilizations as $sterilization){
            $sterilizationsSelect[$sterilization->id] = $sterilization->name;
        }
        $especes = $this->especeRepository->getAll();
        $especesSelect = [];
        foreach($especes as $espece){
            $especesSelect[$espece->id] = $espece->name;
        }
        $races = $this->raceRepository->getAll();
        $racesSelect = [];
        foreach($races as $race){
            $racesSelect[$race->id] = $race->name;
        }
        $foods = $this->foodRepository->getAll();
        $foodsSelect = [];
        foreach($foods as $food){
            $foodsSelect[$food->id] = $food->name;
        }
        $sports = $this->sportRepository->getAll();
        $sportsSelect = [];
        foreach($sports as $sport){
            $sportsSelect[$sport->id] = $sport->name;
        }
        $environments = $this->environmentRepository->getAll();
        $environmentsSelect = [];
        foreach($environments as $environment){
            $environmentsSelect[$environment->id] = $environment->name;
        }

        $selectData = array(
            'agesSelect' => $agesSelect,
            'weightsSelect' => $weightsSelect,
            'gendersSelect' => $gendersSelect,
            'sterilizationsSelect' => $sterilizationsSelect,
            'especesSelect' => $especesSelect,
            'racesSelect' => $racesSelect,
            'foodsSelect' => $foodsSelect,
            'sportsSelect' => $sportsSelect,
            'environmentsSelect' => $environmentsSelect,
            'weightsSelect' => $weightsSelect
        );

        foreach($selectData as &$select)
        {
            $select[0] = 'All';
            ksort($select);
        }

        return compact('agesSelect', 'weightsSelect', 'gendersSelect', 'sterilizationsSelect',
            'especesSelect', 'racesSelect', 'foodsSelect', 'sportsSelect', 'environmentsSelect');
    }

    private function getAnimalConseils($animal)
    {
        $conseilsList = array();

        $conseils = $this->conseilRepository->getAll();
        foreach($conseils as $conseil)
        {
            $valid = true;

            //age
            $conseilAges = $conseil->ages;
            if($conseilAges->count() == 0)
            {
                $conseilAges = $this->ageRepository->getAll();
            }
            $conseilAgesIds = array();
            foreach($conseilAges as $conseilAge)
            {
                $conseilAgesIds[] = $conseilAge->id;
            }
            $animalAge = $animal->age->id;
            $valid = in_array($animalAge, $conseilAgesIds) ? $valid : false;

            //environment
            $conseilEnvironments = $conseil->environments;
            if($conseilEnvironments->count() == 0)
            {
                $conseilEnvironments = $this->ageRepository->getAll();
            }
            $conseilEnvironmentsIds = array();
            foreach($conseilEnvironments as $conseilEnvironment)
            {
                $conseilEnvironmentsIds[] = $conseilEnvironment->id;
            }
            $animalEnvironments = $animal->environments;
            $animalEnvironmentsIds = array();
            foreach($animalEnvironments as $animalEnvironment)
            {
                $animalEnvironmentsIds[] = $animalEnvironment->id;
            }
            $valid = (count(array_intersect($animalEnvironmentsIds, $conseilEnvironmentsIds)) > 0) ? $valid : false;

            //espece
            $conseilEspeces = $conseil->especes;
            if($conseilEspeces->count() == 0)
            {
                $conseilEspeces = $this->ageRepository->getAll();
            }
            $conseilEspecesIds = array();
            foreach($conseilEspeces as $conseilEspece)
            {
                $conseilEspecesIds[] = $conseilEspece->id;
            }
            $animalEspece = $animal->espece->id;
            $valid = in_array($animalEspece, $conseilEspecesIds) ? $valid : false;

            //food
            $conseilFoods = $conseil->foods;
            if($conseilFoods->count() == 0)
            {
                $conseilFoods = $this->ageRepository->getAll();
            }
            $conseilFoodsIds = array();
            foreach($conseilFoods as $conseilFood)
            {
                $conseilFoodsIds[] = $conseilFood->id;
            }
            $animalFoods = $animal->foods;
            $animalFoodsIds = array();
            foreach($animalFoods as $animalFood)
            {
                $animalFoodsIds[] = $animalFood->id;
            }
            $valid = (count(array_intersect($animalFoodsIds, $conseilFoodsIds)) > 0) ? $valid : false;

            //sexe
            $conseilGenders = $conseil->genders;
            if($conseilGenders->count() == 0)
            {
                $conseilGenders = $this->ageRepository->getAll();
            }
            $conseilGendersIds = array();
            foreach($conseilGenders as $conseilGender)
            {
                $conseilGendersIds[] = $conseilGender->id;
            }
            $animalGender = $animal->gender->id;
            $valid = in_array($animalGender, $conseilGendersIds) ? $valid : false;

            //races
            $conseilRaces = $conseil->races;
            if($conseilRaces->count() == 0)
            {
                $conseilRaces = $this->ageRepository->getAll();
            }
            $conseilRacesIds = array();
            foreach($conseilRaces as $conseilRace)
            {
                $conseilRacesIds[] = $conseilRace->id;
            }
            $animalRaces = $animal->races;
            $animalRacesIds = array();
            foreach($animalRaces as $animalRace)
            {
                $animalRacesIds[] = $animalRace->id;
            }
            $valid = (count(array_intersect($animalRacesIds, $conseilRacesIds)) > 0) ?$valid : false;

            //sport
            $conseilSports = $conseil->sports;
            if($conseilSports->count() == 0)
            {
                $conseilSports = $this->ageRepository->getAll();
            }
            $conseilSportsIds = array();
            foreach($conseilSports as $conseilSport)
            {
                $conseilSportsIds[] = $conseilSport->id;
            }
            $animalSport = $animal->sport->id;
            $valid = in_array($animalSport, $conseilSportsIds) ? $valid : false;

            //sterilisation
            $conseilSterilizations = $conseil->sterilizations;
            if($conseilSterilizations->count() == 0)
            {
                $conseilSterilizations = $this->ageRepository->getAll();
            }
            $conseilSterilizationsIds = array();
            foreach($conseilSterilizations as $conseilSterilization)
            {
                $conseilSterilizationsIds[] = $conseilSterilization->id;
            }
            $animalSterilization = $animal->sterilization->id;
            $valid = in_array($animalSterilization, $conseilSterilizationsIds) ? $valid : false;

            //poids
            $conseilWeights = $conseil->weights;
            if($conseilWeights->count() == 0)
            {
                $conseilWeights = $this->ageRepository->getAll();
            }
            $conseilWeightsIds = array();
            foreach($conseilWeights as $conseilWeight)
            {
                $conseilWeightsIds[] = $conseilWeight->id;
            }
            $animalWeight = $animal->weight->id;
            $valid = in_array($animalWeight, $conseilWeightsIds) ? $valid : false;

            if($valid)
            {
                $conseilsList[] = $conseil;
            }
        }

        return $conseilsList;
    }
}
