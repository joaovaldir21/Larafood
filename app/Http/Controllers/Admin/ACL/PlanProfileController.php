<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Profile;
use Illuminate\Http\Request;

class PlanProfileController extends Controller
{
  protected $plan, $profile;

  //Construtor injetando os objetos de Perfis e de Permissões
  public function __construct(Plan $plan, Profile $profile)
  {
      $this->plan = $plan;
      $this->profile = $profile;
  }

  // Função para exibir as Permissões pelo ID do perfil
  public function profiles($idPlan)
  {
      if (!$plan = $this->plan->find($idPlan)) {
          return redirect()->back();
      }

      $profiles = $plan->profiles()->paginate();

      return view('admin.pages.plans.profiles.profiles', compact('plan', 'profiles'));
  }

  // Função para exibir os plans pelo ID da permissão
  public function plans($idProfile)
  {
      if (!$profile = $this->profile->find($idProfile)) {
          return redirect()->back();
      }

      $plans = $profile->plans()->paginate();

      return view('admin.pages.profiles.plans.plans', compact('profile', 'plans'));
  }


  // Função para listar todos as permissões disponiveis para o perfil
  public function profilesAvailable(Request $request, $idPlan)
  {
      if (!$plan = $this->plan->find($idPlan)) {
          return redirect()->back();
      }
      $filters = $request->except('_token');

      $profiles = $plan->profilesAvailable($request->filter);

      return view('admin.pages.plans.profiles.available', compact('plan', 'profiles', 'filters'));
  }

  // Função para vincular um a perfil a um plano
  public function attachProfilesPlan(Request $request, $idPlan)
  {
      if (!$plan = $this->plan->find($idPlan)) {
          return redirect()->back();
      }

      if (!$request->profiles || count($request->profiles) == 0) {
          return redirect()->back()
                          ->with('info', 'Necessário vincular pelo menos um plano.');
      }

      $plan->profiles()->attach($request->profiles);

      return redirect()->route('plans.profiles', $plan->id)
                      ->with('message', 'Vinculação realizada com sucesso!');
  }

  //Função para desvincular uma perfil de um plano
  public function detachProfilePlan($idPlan, $idProfile)
  {
    $plan = $this->plan->find($idPlan);
    $profile = $this->profile->find($idProfile);

    if (!$plan || !$profile) {
        return redirect()->back();
    }

    $plan->profiles()->detach($profile);

    return redirect()->route('plans.profiles', $plan->id)
                    ->with('message', 'Desvinculação realizada com sucesso!');
  }



}
