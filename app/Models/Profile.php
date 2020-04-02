<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['name', 'description'];

    /**
    *  Relacionamento entre Profile e Permission (obtem as permissões)
    **/
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
    *  Relacionamento entre Profile e plans (obtem as planos)
    **/
    public function plans()
    {
        return $this->belongsToMany(Plan::class);
    }

    // Consulta as Permissão não encontrada com o Perfil
    public function permissionsAvailable($filter = null)
    {
        $permissions =  Permission::whereNotIn('permissions.id', function($query) {
          $query->select('permission_profile.permission_id');
          $query->from('permission_profile');
          $query->whereRaw("permission_profile.profile_id={$this->id}");
        })->where(function ($queryFilter) use ($filter){
          if ($filter)
            $queryFilter->where('permissions.name', 'LIKE', "%{$filter}%");
        })
        ->paginate();

        return $permissions;
    }

}
