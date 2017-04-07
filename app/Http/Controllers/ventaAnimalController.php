<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Animal;
use App\Model\Estado_animal;
use App\Model\Raza;
use App\Model\ventaAnimal;
use DB;
use Datatables;
use Notify;


class ventaAnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('venta.venta_animal');
    }

    public function listarView(){

        return view('venta.listar_ventas');

    }




    public function pdf($id){


      $variable=Animal::select('Animal.*','raza.Nombre as ra','venta_animal.*')
      ->join('venta_animal','Animal.Codigo','=','venta_animal.Codigo_animal')
      ->join('raza','Animal.Codigo_raza','=','raza.Codigo')
      ->where('venta_animal.Codigo','=',$id)
      ->get();



      $view =  \View::make('venta.detalle_pdf', compact('variable'))->render();
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($view);
      
      return $pdf->download('venta.detalle_pdf.pdf', compact('variable'));


        // $var =\PDF::LoadView('venta.detalle_pdf');

        // return $var->download('Prueba.pdf');
        // return $variable;


  }



public function excel(){

    \Excel::create('Reporte de ventas de animal' , function ($excel){

        $excel->sheet('Sheetname',function ($sheet){


            $variable=Animal::select('Animal.Marcado','Animal.Nombre','Animal.Fecha_nacimiento as Fecha de nacimiento','Animal.Sexo','Animal.Peso','raza.Nombre as Raza','venta_animal.Fecha_venta as Fecha de venta','venta_animal.Valor','venta_animal.created_at as Creado','venta_animal.updated_at as Ultima modificacion')
            ->join('venta_animal' , 'Animal.Codigo','=','venta_animal.Codigo_animal')
            ->join('raza','raza.Codigo','=','Animal.Codigo_raza')
            ->get();

            $sheet->fromArray($variable);

        });


    })->download('xlsx');





}


public function getAnimal(){    

   $variable=Animal::select('Animal.*','estado_animal.Nombre as estado','raza.Nombre as razav')->where('Animal.Codigo_estado','=',1)
   ->join('estado_animal' , 'estado_animal.Codigo','=','Animal.Codigo_estado')
   ->join('raza','raza.Codigo','=','Animal.Codigo_raza')
   ->get();

   return Datatables::of($variable)
   ->addColumn('action', function ($variable) {

            // Boton de la vista en detalle del listar
    $btnAgregar='<a href="#" class="btn btn-xs btn-primary" onclick="ventas.seleccionarAnimal('.$variable->Codigo.')"><i class="fa fa-plus"></i> Seleccione</a>';

    return $btnAgregar;
})
   ->make(true);    

}

public function consulta($id){

    $consulta=Animal::select('Animal.*')->where('Codigo','=',$id)->get();
    return response()->json($consulta);

}

public function listar_ventas(){

    $variable=ventaAnimal::select('Animal.Nombre','venta_animal.*')
    ->join('Animal','Animal.Codigo','=','venta_animal.Codigo_animal')
    ->get();
    // return json_decode($variable);
    return Datatables::of($variable)
    ->addColumn('action', function ($variable) {
            // Boton de la vista en detalle del listar
        $btnAgregar='<a href="#" class="btn btn-xs btn-primary" onclick="ventas.editar_ventas('.$variable
        ->Codigo.');"><i class="fa fa-plus"></i> Editar</a>';

        return $btnAgregar;
    })
    ->make(true);  

}


public function create()
{

}

public function mostrar(){


}
public function store(Request $request,$id){



}





public function show($id)
{
        //
}


public function edit($id)
{


    $variable=Animal::select('Animal.*','raza.Nombre as ra','venta_animal.*')
    ->join('venta_animal','Animal.Codigo','=','venta_animal.Codigo_animal')
    ->join('raza','Animal.Codigo_raza','=','raza.Codigo')
    ->where('venta_animal.Codigo','=',$id)
    ->get();


    return json_decode($variable);

}


public function update(Request $request, $id)
{


    if ($request -> ajax()){

        $vacu=ventaAnimal::select('venta_animal.*')->where('venta_animal.Codigo','=',$id)->first();

        if($vacu != null){


            $query= DB::table('venta_animal')
            ->where('Codigo','=',$id)
            ->update([
                'Fecha_venta'=>$request->input('Fecha_venta'),
                'Valor'=>$request->input('Valor'),
                
                ]);

            return json_encode(["mensaje" => 1]);

        }else {

            return json_encode(["mensaje" =>2]);
        }


    }

}

public function destroy($id)
{
        //
}

public function guardarVentas(Request $request){


    ventaAnimal::create([

        "Codigo_animal"=>$request->input('Codigo_animal'),
        "Fecha_venta"=>$request->input('Fecha_venta'),
        "Valor"=>$request->input('Valor'),
        Animal::where('Animal.Codigo','=',$request->input('Codigo_animal'))->update(['Animal.Codigo_estado'=>2])


        ]);

    Notify::success('Se guardo correctamente','Noticia');
    return view('venta.venta_animal');

}

}
