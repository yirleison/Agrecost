<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Notify;
use Datatables;
use App\Model\Corral;
use DB;


class corralesController extends Controller
{
  public function index(){
    return view('corrales.registro');
  }

  public function crear_corral(Request $request){

    $tipo ="";
    if ($request->input('tipo') == 0) {
      $tipo = "Enfermos";
    }elseif ($request->input('tipo') == 1) {
      $tipo = "Terneros";
    }elseif ($request->input('tipo') == 2) {
      $tipo = "Produccion";
    }elseif ($request->input('tipo') == 3) {
      $tipo = "Parto";
    }

    $corral = Corral::create([
      'Tipo'=>  $tipo,
      'Capacidad' => $request->input('capacidad'),
      'Estado'=> "Disponible",
    ]);


    if ($corral != null) {
      Notify::success("Registro","Registro exitoso");
      return redirect()->route('corral');
    }
    else{
      Notify::info("Registro","Ha ocurrido un error  al realizar esta operación");
      return redirect()->route('corral');
    }

  }

  public function listar_corrales() {
    return view('corrales.listarCorrales');
  }


  public function getTabla(){
    $corrales = new Corral();
    $corrales = Corral::all();

    return Datatables::of($corrales)

    ->addColumn('action', function ($corrales) {

      $btn_editar = '<a href="#" class="bt btn-primary btn-xs botones" onclick="corral.editar('.$corrales->Codigo.')" id="editar" ><i class="fa fa-plus" aria-hidden="true"></i>
      </a>';
      return $btn_editar;
    })->make(true);
  }


  public function editar($id){

    $corral_editar = Corral::where('Codigo', $id)->get();

    return json_encode($corral_editar);
  }

  public  function actualizar(Request $request, $id){

    $corral = Corral::where('Codigo', $id)->first();
      $estado ="";
        $tipo ="";
    if ($corral !=null) {

      if ($request->input('estado') == 0) {
        $estado = "Disponible";
      }elseif ($request->input('estado') == 1) {
        $estado = "Lleno";
      }elseif ($request->input('estado') == 2) {
        $estado = "Produccion";
      }

      if ($request->input('tipo') == 0) {
        $tipo = "Enfermos";
      }elseif ($request->input('tipo') == 1) {
        $tipo = "Terneros";
      }elseif ($request->input('tipo') == 2) {
        $tipo = "Produccion";
      }elseif ($request->input('tipo') == 3) {
        $tipo = "Parto";
      }

      $query = DB::table('corrales')
      ->where('Codigo',  '=' ,$id )
      ->update([
        'Tipo' => $tipo,
        'Estado' => $estado,
        'Capacidad' =>$request->input('capacidad'),
      ]);

      if (  $query !=null) {
        return json_encode(["mensaje"=>1]);
      }
      else {
        return json_encode(["mensaje"=>2]);
      }
    }
    else {
      return json_encode(["mensaje"=>3]);
    }
  }


}
