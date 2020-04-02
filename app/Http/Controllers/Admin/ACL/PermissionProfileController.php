<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Profile;
use Illuminate\Http\Request;

class PermissionProfileController extends Controller
{
    protected $profile, $permission;

    //Construtor injetando os objetos de Perfis e de Permissões
    public function __construct(Profile $profile, Permission $permission)
    {
        $this->profile = $profile;
        $this->permission = $permission;
    }

    // Função para exibir as Permissões pelo ID do perfil
    public function permissions($idProfile)
    {
        $profile = $this->profile->find($idProfile);

        if (!$profile) {
            return redirect()->back();
        }

        $permissions = $profile->permissions()->paginate();

        return view('admin.pages.profiles.permissions.permissions', compact('profile', 'permissions'));
    }

    // Função para exibir os profiles pelo ID da permissão
    public function profiles($idPermission)
    {
        if (!$permission = $this->permission->find($idPermission)) {
            return redirect()->back();
        }

        $profiles = $permission->profiles()->paginate();

        return view('admin.pages.permissions.profiles.profiles', compact('permission', 'profiles'));
    }


    // Função para listar todos as permissões disponiveis para o perfil
    public function permissionsAvailable(Request $request, $idProfile)
    {
        if (!$profile = $this->profile->find($idProfile)) {
            return redirect()->back();
        }
        $filters = $request->except('_token');

        $permissions = $profile->permissionsAvailable($request->filter);

        return view('admin.pages.profiles.permissions.available', compact('profile', 'permissions', 'filters'));
    }

    // Função para vincular uma permissão a um perfil
    public function attachPermissionsProfile(Request $request, $idProfile)
    {
        if (!$profile = $this->profile->find($idProfile)) {
            return redirect()->back();
        }

        if (!$request->permissions || count($request->permissions) == 0) {
            return redirect()->back()
                            ->with('info', 'Necessário vincular pelo menos uma Permissão.');
        }

        $profile->permissions()->attach($request->permissions);

        return redirect()->route('profiles.permissions', $profile->id)
                        ->with('message', 'Vinculação realizada com sucesso!');
    }

    //Função para desvincular uma permissão de um perfil
    public function detachPermissionProfile($idProfile, $idPermission)
    {
      $profile = $this->profile->find($idProfile);
      $permission = $this->permission->find($idPermission);

      if (!$profile || !$permission) {
          return redirect()->back();
      }

      $profile->permissions()->detach($permission);

      return redirect()->route('profiles.permissions', $profile->id)
                      ->with('message', 'Desvinculação realizada com sucesso!');
    }



}
