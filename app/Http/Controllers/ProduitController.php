<?php

namespace App\Http\Controllers;

use App\Repositories\ProduitRepository;
use App\Repositories\ProduittagRepository;
use App\Http\Requests\ProduitUpdateRequest;
use App\Http\Requests\ProduitCreateRequest;
use App\Http\Requests\ProduittagRequest;
use Illuminate\Support\Facades\Auth;

class ProduitController extends Controller
{

    protected $produitRepository;
    protected $produittagRepository;

    protected $nbrPerPage = 10;

    public function __construct(ProduitRepository $produitRepository, ProduittagRepository $produittagRepository)
    {
        $this->middleware('auth');
        $this->produitRepository = $produitRepository;
        $this->produittagRepository = $produittagRepository;
    }

    public function index()
    {
        $produits = $this->produitRepository->getAllPaginate($this->nbrPerPage);
        $links = $produits->render();
        $tags = $this->produittagRepository->getAll();

        $select = [];
        foreach($tags as $tag){
            $select[$tag->id] = $tag->name;
        }

        return view('produit.index', compact('produits', 'links', 'select'));
    }

    public function create()
    {
        $tags = $this->produittagRepository->getAll();
        $select = [];
        foreach($tags as $tag){
            $select[$tag->id] = $tag->tag;
        }
        return view('produit.create', compact('select'));
    }

    public function edit($id)
    {
        $produit = $this->produitRepository->getById($id);
        $tags = $this->produittagRepository->getAll();

        $select = [];
        foreach($tags as $tag){
            $select[$tag->id] = $tag->tag;
        }

        return view('produit.edit', compact('produit', 'select'));
    }

    public function show($id)
    {
        $produit = $this->produitRepository->getById($id);

        return view('produit.show', compact('produit'));
    }

    public function store(ProduitCreateRequest $request)
    {
        //
    }

    public function destroy($id)
    {
        $this->produitRepository->destroy($id);

        return redirect('produit')->withOk("Le produit a été supprimé.");
    }

    public function redirectProduittag(ProduittagRequest $request)
    {
        $tag_id  = $request->input('tag_id');

        return redirect('produit/tag/' . $tag_id);
    }

    public function indexProduittag($tag_id)
    {
        $produits = $this->produitRepository->getByProduittagPaginate($tag_id, $this->nbrPerPage);
        $links = $produits->render();
        $tags = $this->produittagRepository->getAll();
        $select = $this->getTagsIdsForSelect($tags);
        $tag = $this->produittagRepository->getById($tag_id);

        return view('produit.index', compact('produits', 'links', 'select', 'tag'));
    }

    public function update(ProduitUpdateRequest $request, $id)
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