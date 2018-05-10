<?php 

namespace App\Http\Controllers;

use App\Repositories\ArticleRepository;
use App\Repositories\TagRepository;
use App\Http\Requests\ArticleUpdateRequest;
use App\Http\Requests\ArticleCreateRequest;

class ArticleController extends Controller
{

    protected $articleRepository;
    protected $tagRepository;

    protected $nbrPerPage = 5;

    public function __construct(ArticleRepository $articleRepository, TagRepository $tagRepository)
    {
        $this->middleware('auth', ['except' => ['index', 'indexTag', 'show']]);
        $this->middleware('admin', ['only' => ['destroy', 'create']]);

        $this->articleRepository = $articleRepository;
        $this->tagRepository = $tagRepository;
    }

    public function index()
    {
        $articles = $this->articleRepository->getAllPaginate($this->nbrPerPage);
        $links = $articles->render();
        $tags = $this->tagRepository->getAll();

        return view('article.index', compact('articles', 'links', 'tags'));
    }

    public function create()
    {
        $tags = $this->tagRepository->getAll();
        $select = [];
        foreach($tags as $tag){
            $select[$tag->id] = $tag->tag;
        }
        return view('article.create', compact('select'));
    }

    public function edit($id)
    {
        $article = $this->articleRepository->getById($id);
        $tags = $this->tagRepository->getAll();

        $select = [];
        foreach($tags as $tag){
            $select[$tag->id] = $tag->tag;
        }

        return view('article.edit', compact('article', 'select'));
    }

    public function show($id)
    {
        $article = $this->articleRepository->getById($id);

        return view('article.show', compact('article'));
    }

    public function store(ArticleCreateRequest $request)
    {
        $article = $this->articleRepository->store($request->all());

        return redirect('article')->withOk("Le produit " . $article->name . " a été créé.");
    }

    public function destroy($id)
    {
        $this->articleRepository->destroy($id);

        return redirect('article')->withOk("Le produit a été supprimé.");
    }

    public function indexTag($tag)
    {
        $articles = $this->articleRepository->getByTagPaginate($tag, $this->nbrPerPage);
        $links = $articles->render();
        $tags = $this->tagRepository->getAll();
        $tag = $this->tagRepository->getById($tag);

        return view('article.index', compact('articles', 'links', 'tags'))
        ->with('info', 'Résultats pour la recherche du mot-clé : ' . $tag->tag);
    }

    public function update(ArticleUpdateRequest $request, $id)
    {
        $this->articleRepository->update($id, $request->all());

        return redirect('article')->withOk("Le produit " . $request->input('name') . " a été modifié.");
    }

}