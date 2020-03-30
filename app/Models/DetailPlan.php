<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPlan extends Model
{
    //Tabela de detalhes do plano
    protected $table = 'details_plan';
    protected $fillable = ['name'];

    // Relacionamento de muitos para um entre DETALHES e PLANO
    public function plan()
    {
      return $this->belongsTo(Plan::class);
    }

}
