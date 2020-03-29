<?php

/*
|--------------------------------------------------------------------------
| ROTAS ADMIN PARA PLANOS
|--------------------------------------------------------------------------
*/
Route::any('admin/plans/search', 'Admin\PlanController@search')->name('plans.search'); //Rota para pesquisa
Route::delete('admin/plans/{url}', 'Admin\PlanController@destroy')->name('plans.destroy'); //Rota para deletar um plano
Route::get('admin/plans/{url}', 'Admin\PlanController@show')->name('plans.show'); //Rota para exibir os detalhes de um plano
Route::post('admin/plans', 'Admin\PlanController@store')->name('plans.store'); //Rota para salvar um plano do banco de dados
Route::get('admin/plans/create', 'Admin\PlanController@create')->name('plans.create'); //Rota para Cadastrar um novo plano
Route::get('admin/plans', 'Admin\PlanController@index')->name('plans.index'); //Rota para listar todos planos





Route::get('/', function () {
    return view('welcome');
});
