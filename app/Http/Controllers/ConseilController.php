<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ConseilRepository;
use App\Repositories\ConseiltagRepository;
use App\Http\Requests\ConseiltagRequest;

class ConseilController extends Controller
{
    protected $nbrPerPage = 15;
    protected $conseilRepository;
    protected $conseiltagRepository;

    public function __construct(ConseilRepository $conseilRepository, ConseiltagRepository $conseiltagRepository)
    {
        $this->middleware('auth');
        $this->conseilRepository = $conseilRepository;
        $this->conseiltagRepository = $conseiltagRepository;
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
        $tags = $this->conseiltagRepository->getAll();
        $select = $this->getTagsIdsForSelect($tags);

        return view('conseil.index', compact('conseils', 'links', 'select'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function redirectConseiltag(ConseiltagRequest $request)
    {
        $tag_id  = $request->input('tag_id');

        return redirect('conseil/tag/' . $tag_id);
    }

    public function indexConseiltag($tag_id)
    {
        $conseils = $this->conseilRepository->getByConseiltagPaginate($tag_id, $this->nbrPerPage);
        $links = $conseils->render();
        $tags = $this->conseiltagRepository->getAll();
        $select = $this->getTagsIdsForSelect($tags);
        $tag = $this->conseiltagRepository->getById($tag_id);

        return view('conseil.index', compact('conseils', 'links', 'select', 'tag'));
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
        return view('conseil.show', compact('conseil'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

    public function getTagsIdsForSelect($tags)
    {
        $select = [];
        foreach($tags as $tag){
            $select[$tag->id] = $tag->name;
        }
        return $select;
    }
}
