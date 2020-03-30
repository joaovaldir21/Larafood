<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreUpdateDetailPlan;
use App\Http\Controllers\Controller;
use App\Models\DetailPlan;
use App\Models\Plan;
use Illuminate\Http\Request;

class DetailPlanController extends Controller
{
    protected $repository, $plan;

    // Construtor da classe
    public function __construct(DetailPlan $detailPlan, Plan $plan)
    {
      $this->repository = $detailPlan;
      $this->plan = $plan;
    }

    // exibe os DETALHES
    public function index($urlPlan)
    {
      if (!$plan = $this->plan->where('url', $urlPlan)->first()) {
        return redirect()->back();
      }

    //  $details = $plan->details();
    $details = $plan->details()->paginate();

      return view('admin.pages.plans.details.index', [
        'plan' => $plan,
        'details' => $details,
      ]);
    }

    //Função para exibir o formulário de criação de um novo DETALHE de plano
    public function create($urlPlan)
    {
      if (!$plan = $this->plan->where('url', $urlPlan)->first()) {
        return redirect()->back();
      }

      return view('admin.pages.plans.details.create', [
        'plan' => $plan,
      ]);
    }

    // Função para salvar a criação de um novo detalhe de plano
    public function store(StoreUpdateDetailPlan $request, $urlPlan)
    {
      if (!$plan = $this->plan->where('url', $urlPlan)->first()) {
        return redirect()->back();
      }
      // Um dos métodos de cadastro
      // $data = $request->all();
      // $data['plan_id'] = $plan->id;
      // $this->repository->create($data);

      // Método de cadastro mais simples utilizando o relacionamento DETAILS()
      $plan->details()->create($request->all());

      return redirect()->route('details.plan.index', $plan->url);
    }

    //Função para editar um detalhe de um plano
    public function edit($urlPlan, $idDetail)
    {
      $plan = $this->plan->where('url', $urlPlan)->first();
      $detail = $this->repository->find($idDetail);

      if (!$plan || !$detail) {
        return redirect()->back();
      }

      return view('admin.pages.plans.details.edit', [
        'plan' => $plan,
        'detail' => $detail,
      ]);
    }

    public function update(StoreUpdateDetailPlan $request, $urlPlan, $idDetail)
    {
      $plan = $this->plan->where('url', $urlPlan)->first();
      $detail = $this->repository->find($idDetail);

      if (!$plan || !$detail) {
        return redirect()->back();
      }
      $detail->update($request->all());

      return redirect()->route('details.plan.index', $plan->url);
    }


}
