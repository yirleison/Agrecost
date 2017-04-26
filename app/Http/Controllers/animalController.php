<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegAnimalRequest;
use App\Model\Animal;
use App\Model\Raza;
use App\Model\Estado;
use Datatables;
use Notify;
use DB;

class animalController extends Controller
{
    public function index(Request $request)
    {
        if($request)
        {          
            $Raza = Raza::all();
            return view ('Animal.registroAnimal',compact('Raza'));
        }
    }
    public function create()
    {

    }
    public function store(RegAnimalRequest $request)
    {
        /*Se hace una instancia al Modelo*/
        $animal = new Animal();
        /*Marcado = nombre de la base de datos ('Marcado') = Name de la vista*/
        $animal ->Marcado=$request->get('Marcado');
        $animal ->Nombre=$request->get('Nombre');
        $animal ->Fecha_nacimiento=$request->get('Fecha');
        $animal ->Sexo=$request->get('Sexo');
        $animal ->Peso=$request->get('Peso');
        $animal ->Codigo_raza=$request->get('Raza');
        if($animal!=null)
        {
            // Mensaje del Pnotify
            Notify::Success("El Registro Fue Exitoso","Registro Animal");
            $animal ->save();
            return redirect()->route('Animal.index');
        }     

    }
    public function edit($id)
    {

    }

    public function Inactivar(Request $request)
    {
        Notify::Error("Exitoso","Inactivar");
        $v = [];
        foreach ($request->input('Inactivar') as $id) 
        {     
           $v= ["Codigo" => $id];
           DB::table('animal')
            ->where('Codigo', $v)
            ->update(['Codigo_estado'=>3]);
        }
        return json_encode(["mensaje"=>1]);           
    }

    public function registroRaza(Request $request)
    {
        $raza = new Raza();
        $raza ->Nombre=$request->get('NombreRaza');
        $raza ->save();
        Notify::Success("El Registro Fue Exitoso","Registro Raza");
        return redirect()->route('Animal.index');
    }
    public function update(Request $request, $id)
    {
        $animal = Animal::where('Codigo','=',$id)->first();

        $animal_editar = [
        'Marcado' => $request->input('chapeta'),
        'Nombre' => $request->input('nombre'),
        'Fecha_nacimiento' => $request->input('fecha_nacimiento'),
        'Sexo' => $request->input('sexo'),
        'Peso' => $request->input('peso'),
        'Codigo_estado' => $request->input('estado'),
        'Codigo_raza' => $request->input('raza')
        ];
        if($animal!=null)
        {
            // Mensaje del Pnotify
            DB::table('animal')
            ->where('Codigo', $id)
            ->update($animal_editar);
            return ($animal);
        } 
    }
    public function ListaAnimales()
    {
        $Estado = Estado::all(); 
        $Raza = Raza::all(); 
        return view ('Animal.listarAnimal', compact('Estado','Raza'));
    }
    public function ConsultaAnimales()
    {
        $animales = Animal::select('animal.*','raza.Nombre as raza','estado_animal.Nombre as estado')
        ->join('raza','raza.Codigo','=','animal.Codigo_raza')
        ->join('estado_animal','estado_animal.Codigo','=','animal.Codigo_estado')
        ->where('estado_animal.Nombre','!=','Inactivo');
        return Datatables::of($animales)
        // Agregar el boton
        ->addColumn('action', function ($animales) {
            // Llamado a la funcion del ajax del listar
            $editar='<a href="#" onclick="editar('.$animales->Codigo.');"  id="btn_modal" class="btn btn-xs btn-success"><img src="/librerias/Imagenes/Iconos/edit.png" alt=""> Editar</a>
            <input name="Inactivar[]" value="'.$animales->Codigo.'" type="checkbox" id="Inactivar" aria-label="...">Inactivar';
            return $editar;
        })
        ->make(true);
    }
    public function destroy($id)
    {

    }
    public function editar_animal($id) 
    {
        $animal = Animal::select('animal.*','raza.Nombre as raza','estado_animal.Nombre as estado')
        ->join('raza','raza.Codigo','=','animal.Codigo_raza')
        ->join('estado_animal','estado_animal.Codigo','=','animal.Codigo_estado')
        ->where('animal.Codigo','=',$id)->first();
        return json_encode($animal);
    }
}
