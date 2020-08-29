<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\ProduitRepository;
use App\Repositories\ImageRepository;
use App\Repositories\ProduittagRepository;
use App\Http\Requests\ProduitUpdateRequest;
use App\Http\Requests\ProduitCreateRequest;
use App\Http\Requests\ProduittagRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ProduitController extends Controller
{
    protected $produitRepository;
    protected $produittagRepository;
    protected $imageRepository;

    protected $nbrPerPage = 10;

    public function __construct(ProduitRepository $produitRepository, ProduittagRepository $produittagRepository,
        ImageRepository $imageRepository)
    {
        $this->middleware('admin');
        $this->produitRepository = $produitRepository;
        $this->produittagRepository = $produittagRepository;
        $this->imageRepository = $imageRepository;
    }

    public function index()
    {
        $produits = $this->produitRepository->getAllPaginate($this->nbrPerPage);
        $links = $produits->render();
        $tags = $this->produittagRepository->getAll();
        $select = $this->getTagsIdsForSelect($tags);

        return view('admin.produit.index', compact('produits', 'links', 'select'));
    }

    public function create()
    {
        $tags = $this->produittagRepository->getAll();
        $select = $this->getTagsIdsForSelect($tags);
        return view('admin.produit.create', compact('select'));
    }

    public function edit($id)
    {
        $produit = $this->produitRepository->getById($id);
        $tags = $this->produittagRepository->getAll();

        $select = $this->getTagsIdsForSelect($tags);

        return view('admin.produit.edit', compact('produit', 'select'));
    }

    public function show($id)
    {
        $produit = $this->produitRepository->getById($id);

        return view('admin.produit.show', compact('produit'));
    }

    public function store(ProduitCreateRequest $request)
    {
        $attributes = array(
            'name' => $request->input('name'),
            'short_description' => $request->input('short_description'),
            'description' => $request->input('description'),
            'price' => $request->input('price')
        );

        if($request->hasFile('image'))
        {
            //store new image
            $name = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path() . '/images/', $name);
            $image = $this->imageRepository->store(array('name' => $name));
            $attributes['image_id'] = $image->id;
        }

        $produit = $this->produitRepository->store($attributes);

        $produit->produittags()->attach($request->input('produittag_id'));

        return redirect('produit')->withOk("Le produit " . $produit->name . " a été créé.");
    }

    public function destroy($id)
    {
        $this->produitRepository->destroy($id);

        return redirect('produit')->withOk("Le produit a été supprimé.");
    }

    public function redirectProduittag(ProduittagRequest $request)
    {
        $tag_id  = $request->input('tag_id');

        return redirect('admin/produit/tag/' . $tag_id);
    }

    public function indexProduittag($tag_id)
    {
        $produits = $this->produitRepository->getByProduittagPaginate($tag_id, $this->nbrPerPage);
        $links = $produits->render();
        $tags = $this->produittagRepository->getAll();
        $select = $this->getTagsIdsForSelect($tags);
        $tag = $this->produittagRepository->getById($tag_id);

        return view('admin.produit.index', compact('produits', 'links', 'select', 'tag'));
    }

    public function update(ProduitUpdateRequest $request, $id)
    {
        $produit = $this->produitRepository->getById($id);

        $attributes = array(
            'name' => $request->input('name'),
            'short_description' => $request->input('short_description'),
            'description' => $request->input('description'),
            'price' => $request->input('price')
        );

        if($request->hasFile('image'))
        {
            //if user already has image, delete it
            $image = $produit->image;
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

        $this->produitRepository->update($id, $attributes);

        $produit->produittags()->sync($request->input('produittag_id'));

        return redirect('admin/produit/' . $id)->withOk("Le produit " . $request->input('name') . " a été modifié.");
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