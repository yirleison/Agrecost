<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegMontaRequest;
use App\Model\Animal;
use App\Model\Monta;
use App\Model\Raza;
use App\Model\Estado;
use Datatables;
use Notify;
use DB;

class montaController extends Controller
{
    public function index()
    {
        return view('Monta.registroMonta');
    }

    public function ListaMontas()
    {
        $Animal = Animal::all(); 
        return view ('Monta.listarMonta', compact('Animal'));
    }

    public function ConsultaMontas()
    {
        $montas = Monta::select('t.nombre as toro','v.nombre as vaca','monta.*')
        ->join('animal as t','t.Codigo','=','monta.Codigo_animal_masc')
        ->join('animal as v','v.Codigo','=','monta.Codigo_animal_fem')
        ->where('monta.Estado','!=','No efectiva');
        return Datatables::of($montas)
        // Agregar el boton
        ->addColumn('action', function ($montas) {
            // Llamado a la funcion del ajax del listar
            $editar='<a href="#" onclick="editar('.$montas->Codigo.');"  id="btn_modal" class="btn btn-xs btn-success"><img src="/librerias/Imagenes/Iconos/edit.png" alt=""> Editar</a>'; 
            return $editar;            
        })
        ->make(true);
    }

    public function ConsultaAnimalesM()
    {
        $animales = Animal::select('animal.*','raza.Nombre as raza','estado_animal.Nombre as estado')
        ->join('raza','raza.Codigo','=','animal.Codigo_raza')
        ->join('estado_animal','estado_animal.Codigo','=','animal.Codigo_estado')
        ->where('animal.Sexo','=','Masculino')
        ->where('estado_animal.Nombre','!=','Inactivo');
        return Datatables::of($animales)
        // Agregar el boton
        ->addColumn('action', function ($animales) {
            // Llamado a la funcion del ajax del listar
            $ID='<a href="#" onclick="seleccionToro('.$animales->Codigo.');"  id="btn_modal" class="btn btn-xs btn-success"><img src="/librerias/Imagenes/Iconos/edit.png" alt=""> Seleccionar</a>'; 
            return $ID;            
        })
        ->make(true);
    }

    public function ConsultaAnimalesF()
    {
        $animales = Animal::select('animal.*','raza.Nombre as raza','estado_animal.Nombre as estado')
        ->join('raza','raza.Codigo','=','animal.Codigo_raza')
        ->join('estado_animal','estado_animal.Codigo','=','animal.Codigo_estado')
        ->where('animal.Sexo','=','Femenino')
        ->where('estado_animal.Nombre','!=','Inactivo');
        return Datatables::of($animales)
        // Agregar el boton
        ->addColumn('action', function ($animales) {
            // Llamado a la funcion del ajax del listar
            $ID='<a href="#" onclick="seleccionVaca('.$animales->Codigo.');"  id="btn_modal" class="btn btn-xs btn-success"><img src="/librerias/Imagenes/Iconos/edit.png" alt=""> Seleccionar</a>';
            return $ID;
        })
        ->make(true);
    }

    public function create()
    {

    }

    public function store(RegMontaRequest $request)
    {
        $monta = new Monta();
        /*Marcado = nombre de la base de datos ('Marcado') = Name de la vista*/
        $monta ->Tipo=$request->get('Tipo');
        $monta ->Codigo_animal_masc=$request->get('Toro');
        $monta ->Codigo_animal_fem=$request->get('Vaca');
        $monta ->Fecha_monta=$request->get('Fecha');

        $fecha_secada = date_create($request->get('Fecha'));
        date_add($fecha_secada, date_interval_create_from_date_string('7 months'));
        $monta ->Fecha_secada=$fecha_secada;

        $fecha_palpada = date_create($request->get('Fecha'));
        date_add($fecha_palpada, date_interval_create_from_date_string('90 days'));
        $monta ->Fecha_palpada=$fecha_palpada;

        $monta ->Valor=$request->get('Valor');
        $monta ->Estado=$request->get('Estado');
        $monta ->Observaciones=$request->get('Observaciones');

        $id = $request->get('Vaca');
        $animal = Animal::where('Codigo','=',$id)->first();

        $animal_editar = [
        'Peso' => $request->get('Peso'),
        ];

        if($monta!=null && $animal!=null)
        {
            // Mensaje del Pnotify
            $monta ->save();

            DB::table('animal')
            ->where('Codigo', $id)
            ->update($animal_editar);

            Notify::Success("El Registro Fue Exitoso","Registro Monta");
            return redirect()->route('Monta.index');
        }
    }

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function editar_monta($id) 
    {
        $montas = Monta::select('t.Nombre as toro','v.Nombre as vaca','v.Peso as peso','monta.*')
        ->join('animal as t','t.Codigo','=','monta.Codigo_animal_masc')
        ->join('animal as v','v.Codigo','=','monta.Codigo_animal_fem')
        ->where('monta.Codigo','=',$id)->first();
        return json_encode($montas);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
