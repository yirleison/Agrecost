<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Tanque;
use Notify;
use Datatables;
use DB;

class tanqueController extends Controller
{
  public function index(){
    return  view('tanque.registroTanque');
  }

  public function crear_tanque(Request $request){

    $tanque = Tanque::create(['Capacidad' => $request->input('capacidad')]);


    if ($tanque != null) {

      Notify::success('Registro tanque','Registro exitoso');

      return redirect()->route('tanques');
    }
    else{
      Notify::info("Registro tanque","Ha ocurrido un error  al realizar esta operación");
      return redirect()->route('tanques');
    }

  }

   public function listar_taques() {
    $cant_tanq = DB::table("tanque")->sum("Cantidad");
     return view('tanque.listarTanques',compact("cant_tanq"));
   }

   public function getTabla(){

    $tanques = Tanque::all();


    return Datatables::of($tanques)

    ->addColumn('action', function ($tanques) {

      $btn_editar = '<a href="#" class="bt btn-primary btn-xs botones" onclick="tanque.editar('.$tanques->Codigo.')" id="editar" ><i class="fa fa-plus" aria-hidden="true"></i>
      </a>';
      return $btn_editar;
    })->make(true);
  }

   public function editar($id){

    $tanque_editar = new Tanque();
    $tanque_editar = Tanque::where('Codigo', $id)->get();

    return json_encode($tanque_editar);
  }

   public  function actualizar(Request $request, $id){

    $tanque = new Tanque();

    $tanque = Tanque::where('Codigo', $id)->first();

    $estado ="";
    if ($request->input('estado') == 0) {
      $estado = "Disponible";
    }elseif ($request->input('estado') == 1) {
      $estado = "Lleno";
    }elseif ($request->input('estado') == 2) {
      $estado = "Produccion";
    }

    $query = DB::table('tanque')
    ->where('Codigo',  '=' ,$id )
    ->update([
      'Cantidad' => $request->input('cantidad'),
      'Capacidad' => $request->input('capacidad'),
      'Estado' => $estado,
    ]);

    return json_encode(["mensaje"=>1]);
  }

}
