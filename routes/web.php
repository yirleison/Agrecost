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

// Ruta principal
Route::get('/', function () {
    return view('welcome');
});

// Inicio rutas para el módulo tanques......
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
//  Fin rutas módulo tanques....

// Inicio rutas para el módulo corrales....
Route::get('corrales',[
  'as'=>'corral',
  'uses'=>'corralesController@index',
]);

Route::post('registro/corral',[
  'as'=>'registrar-corral',
  'uses'=>'corralesController@crear_corral',
]);

Route::get('editar/corral/{id}',[
  'as'=>'/editar/corral',
  'uses'=>'corralesController@editar',
]);

Route::post('actualizar/corral/{id}',[
  'as'=>'/actualizar/corral',
  'uses'=>'corralesController@actualizar',
]);

Route::get('consultar/corrales',[
  'as'=>'listar-corrales',
  'uses'=>'corralesController@listar_corrales',
]);
Route::get('tabla/corrales','corralesController@getTabla');
// Fin rutas para el módulo corrales....

// Rutas de la venta animal
Route::get('ventaAnimal/getAnimal','ventaAnimalController@getAnimal');
Route::get('/ventaAnimal/consulta/{id}','ventaAnimalController@consulta');
Route::post('/ventaAnimal/guardar','ventaAnimalController@guardarVentas');
Route::get('/ventaAnimal/listar','ventaAnimalController@listarView');
Route::get('/ventaAnimal/listarventas','ventaAnimalController@listar_ventas');
Route::get('/ventaAnimal/mostrar','ventaAnimalController@mostrar');
Route::get('/ventaAnimal/pdf/{id}','ventaAnimalController@pdf');
Route::get('/ventaAnimal/excel','ventaAnimalController@excel');
// Final de las rutas de la venta


// Rutas del promedio de leche por animal
Route::get('/promedioleche/get/{id}','promedioAnimalController@get');
Route::get('/promedioleche/listar','promedioAnimalController@listar');
Route::post('/promedioleche/guardarproduccion','promedioAnimalController@guardarP');
Route::get('/promedioleche/poranimal','promedioAnimalController@vistapromedio_animal');
Route::get('/promedioleche/marcado/{id}','promedioAnimalController@marcado');
// Fina de las rutas del promedio de leche por animal

//Rutas movimiento.....
Route::get('movimiento','movimientoController@index');
Route::get('movimiento/tabla/tanques','movimientoController@listar_tanques');
Route::post('venta/registro','movimientoController@registrar_venta');
Route::post('movimiento/eliminar/venta','movimientoController@eliminar_venta');
Route::post('movimiento/eliminar/produccion','movimientoController@eliminar_produccion');
Route::post('movimiento/registro/produccion','movimientoController@registrar_produccion');
Auth::routes();

Route::get('/home', 'HomeController@index');


// Rutas resource (Estas van de ultima de todas la rutas por obligacion)
Route::resource('ventaAnimal', 'ventaAnimalController');
Route::resource('promedioleche','promedioAnimalController');
//  Fin Rutas resource
