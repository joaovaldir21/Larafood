<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use illuminate\Support\Str;

class PlanController extends Controller
{
    private $repository;

    // Construtor de Planos
    public function __construct(Plan $plan)
    {
        $this->repository = $plan;
    }

    // Função para exibir a pagina de planos e listar todos
    public function index()
    {
        $plans = $this->repository->latest()->paginate();

        return view('admin.pages.plans.index', [
            'plans' => $plans,
        ]);
    }

    //Função para acessar a rota e cadastrar novos planos
    public function create()
    {
        return view('admin.pages.plans.create');
    }

    // Função para salvar as informações de um novo plano no banco de dados
    public function store(Request $request)
    {
        $data = $request->all();
        $data['url'] = Str::kebab($request->name);
        $this->repository->create($data);

        return redirect()->route('plans.index');
    }

    // Função para mostrar as informações de um certo plano pela URL
    public function show($url)
    {
        $plan = $this->repository->where('url', $url)->first();

        if (!$plan)
        {
            return redirect()->back();
        } else {
            return view('admin.pages.plans.show', [
                'plan' => $plan
            ]);
        }

    }

    // Função para deletar um plano do banco de dados pela URL
    public function destroy($url)
    {
        $plan = $this->repository->where('url', $url)->first();

        if (!$plan)
        {
            return redirect()->back();
        } else {
            $plan->delete();
            
            return redirect()->route('plans.index');
        }
        
    }

    // Função para pesquisa de planos
    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $plans = $this->repository->search();

        return view('admin.pages.plans.index', [
            'plans' => $plans,
            'filters' => $filters,
        ]);
    }


}
