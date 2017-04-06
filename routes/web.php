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


Auth::routes();

Route::get('/home', 'HomeController@index');

/*Resource agrupa los metodos para crear, modificar, mostrar, etc creados en el controlador
Animal es la carpeta creada en las vistas y este se une con el controlador*/
// Route::get('/vacunacion/listar', 'vacunacionController@viewListar');
// Route::get('/vacunacion/get', 'vacunacionController@listar');
// Route::post('/vacunacion/tipo', 'vacunacionController@createTipovacuna');
// Route::post('/vacunacion/actualizar/{id}', 'vacunacionController@actualizar
Route::get('ventaAnimal/getAnimal','ventaAnimalController@getAnimal');
Route::get('/ventaAnimal/consulta/{id}','ventaAnimalController@consulta');
Route::post('/ventaAnimal/guardar','ventaAnimalController@guardarVentas');
Route::get('/ventaAnimal/listar','ventaAnimalController@listarView');
Route::get('/ventaAnimal/listarventas','ventaAnimalController@listar_ventas');
Route::get('/ventaAnimal/mostrar','ventaAnimalController@mostrar');
Route::get('/ventaAnimal/pdf/{id}','ventaAnimalController@pdf');
Route::get('/ventaAnimal/excel','ventaAnimalController@excel');




Route::get('/promedioleche/get/{id}','promedioAnimalController@get');
Route::get('/promedioleche/listar','promedioAnimalController@listar');
Route::post('/promedioleche/guardarproduccion','promedioAnimalController@guardarP');
Route::get('/promedioleche/poranimal','promedioAnimalController@vistapromedio_animal');
Route::get('/promedioleche/marcado/{id}','promedioAnimalController@marcado');







Route::resource('ventaAnimal', 'ventaAnimalController');
Route::resource('vacunacion', 'vacunacionController');
Route::resource('Animal','AnimalController');
Route::resource('promedioleche','promedioAnimalController');

// Route::get('vacunacion1/get','VacunacionListarController@listar');
// Route::get('vacunacion1/listar','VacunacionListarController@viewListar');
