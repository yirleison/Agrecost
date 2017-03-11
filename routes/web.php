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
/*Resource agrupa los metodos para crear, modificar, mostrar, etc creados en el controlador
Animal es la carpeta creada en las vistas y este se une con el controlador*/
Route::resource('Animal','AnimalController');
