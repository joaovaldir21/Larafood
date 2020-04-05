<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePlan;
use App\Models\Plan;
use Illuminate\Http\Request;


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
    public function store(StoreUpdatePlan $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('plans.index')
                        ->with('message', 'Registro cadastrado com sucesso!');
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
                'plan' => $plan,
            ]);
        }

    }

    // Função para deletar um plano do banco de dados pela URL
    public function destroy($url)
    {
        $plan = $this->repository
                    ->with('details')
                    ->where('url', $url)
                    ->first();

        if (!$plan)
        {
            return redirect()->back();
        } else {

            if ($plan->details->count() > 0){
                return redirect()
                    ->back()
                    ->with('error', 'Existem detalhes vinculados a este plano, portanto não pode ser deletado.');
            }
            $plan->delete();

            return redirect()->route('plans.index')
            ->with('message', 'Registro deletado com sucesso!');
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

    // Função para editar um plano pela URL
    public function edit($url)
    {
        $plan = $this->repository->where('url', $url)->first();

        if (!$plan)
        {
            return redirect()->back();
        } else {
            return view('admin.pages.plans.edit', [
                'plan' => $plan,
            ]);
        }
    }


    public function update(StoreUpdatePlan $request, $url)
    {
        $plan = $this->repository->where('url', $url)->first();

        if (!$plan)
        {
            return redirect()->back();
        } else {
            $plan->update($request->all());

            return redirect()->route('plans.index')
            ->with('message', 'Registro atualizado com sucesso!');
        }
    }




}
