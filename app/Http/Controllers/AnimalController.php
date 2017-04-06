<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\RegAnimalRequest;
use App\Model\Animal;
use Illuminate\Support\Facades\Redirect;
use DB;

class AnimalController extends Controller
{

    public function index(Request $request)
    {

    }

    public function create()
    {
        return view('Animal.RegistroAnimal');
    }

    /*Se llama la funcion con el metodo POST*/
    public function store(RegAnimalRequest $request)
    {
        /*Se hace una instancia al Modelo*/
        $animal = new Animal();

        $animal ->Marcado=$request->get('Marcado');
        $animal ->Nombre=$request->get('Nombre');
        $animal ->Fecha_nacimiento=$request->get('Fecha');
        $animal ->Sexo=$request->get('Sexo');
        $animal ->Peso=$request->get('Peso');
        $animal ->Estado='Disponible';
        $animal ->Raza=$request->get('Raza');
         /*var_dump($animal);
         exit();*/
         $animal ->save();
         return redirect()->route('Animal.create');
     }


     public function show(Request $id)
     {
        if($request)
        {           
            $Nombre = Animal::all();
            return view ('Animal.index',compact('Nombre'));
        }
    }


    public function edit($id)
    {
        //
    }

    /*Se llama la funcion con el metodo SPATCH*/
    public function update(Request $request, $id)
    {
        //
    }

    /*Se llama la funcion con el metodo DELETE*/
    public function destroy($id)
    {
        //
    }


    
}
