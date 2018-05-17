<?php 

namespace App\Http\Controllers;

use App\Repositories\ArticleRepository;
use App\Repositories\CommandRepository;

use App\Http\Requests\CommandUpdateRequest;

use Illuminate\Support\Facades\Auth;

class CommandController extends Controller
{

    protected $articleRepository;
    protected $tagRepository;
    protected $commandRepository;

    protected $nbrPerPage = 6;

    public function __construct(ArticleRepository $articleRepository, CommandRepository $commandRepository)
    {
        $this->middleware('auth');
        $this->middleware('admin', ['only' => ['update']]);

        $this->articleRepository = $articleRepository;
        $this->commandRepository = $commandRepository;
    }

    public function index()
    {
        if(Auth::user()->admin) {
            $commands = $this->commandRepository->getAllPaginate($this->nbrPerPage);
            $links = $commands->render();
            return view('command.index', compact('commands', 'links'));
        }
        else {

            $commands = $this->commandRepository->getAllByUserPaginate(Auth::user()->id, $this->nbrPerPage);

            $links = $commands->render();

            return view('command.index', compact('commands', 'links'));
            
        }
    }

    public function create($id)
    {
        $article = $this->articleRepository->getById($id);
        return view('command.create', compact('article'));
    }

    public function edit($id)
    {
        $command = $this->commandRepository->getById($id);

        return view('command.edit', compact('command'));
    }

    public function show($id)
    {
        $article = $this->articleRepository->getById($id);

        return view('article.show', compact('article'));
    }

    public function store($id)
    {
        $command = $this->commandRepository->store(Auth::user()->id, $id);

        return redirect('command')->withOk("La commande " . $command->id . " a été créée.");
    }

    public function destroy($id)
    {
        $this->commandRepository->destroy($id);

        return redirect('command')->withOk("La commande a été supprimée.");
    }

    public function update(CommandUpdateRequest $request, $id)
    {
        $this->commandRepository->update($id, $request->all());

        return redirect('command')->withOk("La commande # " . $id . " a été traitée.");
    }

}