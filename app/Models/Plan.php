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

    // Função para pesquisa por NOME e por DESCRIÇÃO
    public function search($filter = null)
    {
        $results = $this
                    ->where('name', 'LIKE', "%{$filter}%")
                    ->orWhere('description', 'LIKE', "%{$filter}%")
                    ->paginate(); // paginate sem valor exibe por padrão 15 por paginas
        return $results;
    }
}
