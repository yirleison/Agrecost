<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('tanques',[
  'as'=>'tanques',
  'uses'=>'tanqueController@index',
]);

Route::post('registro/tanque',[
  'as'=>'registrar-tanque',
  'uses'=>'tanqueController@crear_tanque',
]);

Route::get('consultar/tanques',[
  'as'=>'listar-tanques',
  'uses'=>'tanqueController@listar_taques',
]);

Route::get('tabla/tanques','tanqueController@getTabla');

Route::get('editar/tanque/{id}',[
  'as'=>'/editar/tanque',
  'uses'=>'tanqueController@editar',
]);

Route::post('actualizar/tanque/{id}',[
  'as'=>'/actualizar/tanque',
  'uses'=>'tanqueController@actualizar',
]);

Auth::routes();

Route::get('/home', 'HomeController@index');
