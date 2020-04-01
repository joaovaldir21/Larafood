<?php

/*
|--------------------------------------------------------------------------
| ROTAS ADMIN PARA PLANOS
|--------------------------------------------------------------------------
*/


// prefix('admin') = vem após o verbo HTTP
//namespace('Admin') = vem logo antes do nome do controller
Route::prefix('admin')->namespace('Admin')->group(function() {

/**
* Rotas de RELACIONAMENTO entre Permissões X Perfis
*/
Route::post('profiles/{id}/permissions', 'ACL\PermissionProfileController@attachPermissionsProfile')->name('profiles.permissions.attach');
Route::any('profiles/{id}/permissions/create', 'ACL\PermissionProfileController@permissionsAvailable')->name('profiles.permissions.available');
Route::get('profiles/{id}/permissions', 'ACL\PermissionProfileController@permissions')->name('profiles.permissions');


  /**
  * Rotas das Permissões (Permissions) com RESOURSES - (create, update, edit, destroy, show, strore e index)
  */
  Route::any('permissions/search', 'ACL\PermissionController@search')->name('permissions.search'); //Rota para pesquisa
  Route::resource('permissions', 'ACL\PermissionController');

/**
* Rotas dos Perfis (Profiles) com RESOURSES - (create, update, edit, destroy, show, strore e index)
*/
Route::any('profiles/search', 'ACL\ProfileController@search')->name('profiles.search'); //Rota para pesquisa
Route::resource('profiles', 'ACL\ProfileController');

/**
* Rotas DETALHES de PLANO
*/
Route::get('plans/{url}/details/create', 'DetailPlanController@create')->name('details.plan.create');
Route::put('plans/{url}/details/{idDetail}', 'DetailPlanController@update')->name('details.plan.update');
Route::get('plans/{url}/details/{idDetail}/edit', 'DetailPlanController@edit')->name('details.plan.edit');
Route::delete('plans/{url}/details/{idDetail}', 'DetailPlanController@destroy')->name('details.plan.destroy');
Route::get('plans/{url}/details/{idDetail}', 'DetailPlanController@show')->name('details.plan.show');
Route::post('plans/{url}/details', 'DetailPlanController@store')->name('details.plan.store');
Route::get('plans/{url}/details', 'DetailPlanController@index')->name('details.plan.index');
/**
* Rotas administrativas de PLANO
*/
  Route::get('plans/create', 'PlanController@create')->name('plans.create'); //Rota para Cadastrar um novo plano
  Route::put('plans/{url}', 'PlanController@update')->name('plans.update'); //Rota para salvar a EDIÇÃO de um plano
  Route::get('plans/{url}/edit', 'PlanController@edit')->name('plans.edit'); //Rota para acessar o formulário de editar um plano
  Route::any('plans/search', 'PlanController@search')->name('plans.search'); //Rota para pesquisa
  Route::delete('plans/{url}', 'PlanController@destroy')->name('plans.destroy'); //Rota para deletar um plano
  Route::get('plans/{url}', 'PlanController@show')->name('plans.show'); //Rota para exibir os detalhes de um plano
  Route::post('plans', 'PlanController@store')->name('plans.store'); //Rota para salvar um plano do banco de dados
  Route::get('plans', 'PlanController@index')->name('plans.index'); //Rota para listar todos planos

/*
* Rotas HOME do Dashboard
*/
  Route::get('/', 'PlanController@index')->name('admin.index'); // Rota para acessar a pagina inicial do ADMIN
});



Route::get('/', function () {
    return view('welcome');
});
