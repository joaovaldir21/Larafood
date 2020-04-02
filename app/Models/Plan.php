<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = ['name', 'url', 'price', 'description'];

    // Relacionamento um para muitos entre PLANO e DETALHES
    public function details()
    {
      return $this->hasMany(DetailPlan::class);
    }

    /**
    *  Relacionamento entre plan e profile (obtem os perfis)
    **/
    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }

    // Função para pesquisa por NOME e por DESCRIÇÃO
    public function search($filter = null)
    {
        $results = $this
                    ->where('name', 'LIKE', "%{$filter}%")
                    ->orWhere('description', 'LIKE', "%{$filter}%")
                    ->paginate(); // paginate sem valor exibe por padrão 15 por paginas
        return $results;
    }

    // Consulta os perfis não encontrada com o plano
    public function profilesAvailable($filter = null)
    {
        $profiles =  Profile::whereNotIn('profiles.id', function($query) {
          $query->select('plan_profile.profile_id');
          $query->from('plan_profile');
          $query->whereRaw("plan_profile.plan_id={$this->id}");
        })->where(function ($queryFilter) use ($filter){
          if ($filter)
            $queryFilter->where('profiles.name', 'LIKE', "%{$filter}%");
        })
        ->paginate();

        return $profiles;
    }


}
