<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Tanque;
use App\Model\Movimiento;
use App\Model\Existencia_leche;
use App\Model\Produccion_corral;
use Datatables;
use Notify;
use DB;
use Carbon\Carbon;
use App\Model\Corral;

class movimientoController extends Controller
{
  public function index(){

    $corrales = Corral::where('estado','Disponible')->get();
    return view('movimiento.movimiento',compact('corrales'));
  }

  public function listar_tanques()
  {
    $tanques = Tanque::where('estado', 'Disponible')
    ->where('Cantidad','>','0')
    ->get();

    return Datatables::of($tanques)

    ->addColumn('action', function ($tanques) {

      $btn_seleccione = '<a href="#" class="bt btn-primary btn-xs botones" onclick="addTableRow('.$tanques->Codigo.');" id="addBtn_0"><i class="fa fa-check-square-o" aria-hidden="true"></i>
      Seleccione</a>';
      return $btn_seleccione;
    })->make(true);
  }

  public  function registrar_venta (Request $request){

    $date = Carbon::now();
    $date = $date->format('Y-m-d');
    $up_t = null ; // Variable para validar el insert en la tabla movimiento..
    $cm = null; // Variable para obtener el id despues del registro de la venta....
    $cmv = null;
    $input = $request->all();
    $cv = $input["cantidad"];
    $cv_r = $input["cantidad"]; // Variable cantidad a registrar en la tabla movimiento
    $cv_restante = 0;
    $tanques = DB::table('tanque')->select('tanque.*')
    ->where('Estado','=','Disponible')
    ->orwhere('Estado','=','Lleno')
    ->orderBy('Codigo','ASC')->get()->toArray();

    $tq_update = [];
    $ms = [];
    $aux = 0;
    $cont = 0;


    if (floatval(DB::table('tanque')->sum('Cantidad')) >= $input["cantidad"]) {

      try {

        $cmv = DB::table('movimiento')->insertGetId([
          'Tipo_movimiento' => $input['movimiento'],
          'Cantidad' =>  $cv_r,
          'Valor' =>$input['valor_venta'],
          // 'Jornada'=>$input['jornada'],
          'Fecha' => $date
        ]);

        if ($cmv != null) {

          foreach ($tanques as $key => $value) {

            $update = [];

            if($value->Cantidad != 0 && $cv != 0){

              if($value->Cantidad == $cv){

                array_push($tq_update, ["Codigo"=>$value->Codigo, "Cantidad"=>$cv]);

                $update = ["Cantidad"=>0,"Estado" => "Disponible"];

                $cv = 0;
              }
              elseif($value->Cantidad < $cv){

                $update = ["Cantidad"=>0,"Estado" => "Disponible"];


                $cv = ($cv-$value->Cantidad);

                array_push($tq_update, ["Codigo"=>$value->Codigo, "Cantidad"=>$value->Cantidad]);

                // $aux = $cv;

              }
              else {

                array_push($tq_update, ["Codigo"=>$value->Codigo, "Cantidad"=>$cv]);

                $update = ["Cantidad"=>($value->Cantidad-$cv),"Estado" => "Disponible"];
                $cv = 0;
              }
              $up_t =  DB::table('tanque')->where("Codigo", $value->Codigo)->update($update);

              if ($up_t != null) {
                $cont++;
              }

            }

          }
          if ($cont > 0) {
            foreach ($tq_update as  $valor) {
              if ($valor["Cantidad"] != 0) {
                $ex_l = DB::table('existencia_leche')->insert([
                  'Codigo_tanque' => $valor["Codigo"],
                  'Codigo_movimiento' =>$cmv,
                  'Cantidad' =>  $valor["Cantidad"]
                ]);
              }
            }
          }
          if ($ex_l !=null) {
            $dt_vt = DB::table('movimiento')->select('movimiento.*')->where('Codigo',$cmv)->get();
            return json_encode([$dt_vt,"mensaje"=>1]);
          }
        }

      } catch (Exception $e) {
        $ms=["mensaje"=>2];
      }
    }else{
      $ms =["mensaje"=>3];
      return json_encode([$ms]);
    }
  }

  public function registrar_produccion (Request $request){
    $date = Carbon::now();
    $date = $date->format('Y-m-d');
    $input = $request->all();
    $cp = $input["cantidad"];
    $ca_m = $input["cantidad"];
    $ms =0;
    $cont = 0;
    $cmv = null;
    $tq_existencia = [];
    $aux = 0;

    try {

      $tanques = DB::table('tanque')->select('tanque.*')
      ->where('Estado','=','Disponible')
      ->orwhere('Estado','=','Lleno')
      ->orderBy('Codigo','ASC')->get()->toArray();

      $cmv = DB::table('movimiento')->insertGetId([
        'Tipo_movimiento' => $input['movimiento'],
        'Cantidad' =>  $ca_m,
        'Fecha' => $date
      ]);

      if ($cmv != null) {

        foreach($tanques as $key => $value){
          $cp_u = [];

          $can_cp = ($value->Cantidad + $cp);

          if($can_cp == $value->Capacidad ){

            array_push($tq_existencia,["Codigo"=>$value->Codigo,"Cantidad"=> $cp]);

            $cp_u = ["Cantidad" => ($cp + $value->Cantidad),"Estado"=>"Lleno"];

            $cp = 0;
          }else if ($can_cp < $value->Capacidad) {

            array_push($tq_existencia, ["Codigo"=>$value->Codigo,"Cantidad" => $cp]);

            $cp_u = ["Cantidad" => ($cp + $value->Cantidad)];

            $aux = $cp;

            $cp = 0;

          }else if ($can_cp > $value->Capacidad ) {

            $r_cap = ($can_cp-$value->Capacidad);

            $cp_u = ["Cantidad" => ($value->Capacidad),"Estado"=>"Lleno"];

            array_push($tq_existencia, ["Codigo"=>$value->Codigo,"Cantidad" => $r_cap]);

            $cp =   $r_cap;
          }

          $up_c =  DB::table('tanque')->where("Codigo", $value->Codigo)->update($cp_u);
          if ($up_c != null) {
            $cont++;
          }
        }
        if ($cont > 0) {
          foreach ($tq_existencia as  $val) {
            if($val["Cantidad"] != 0){
              $ex_l = DB::table('existencia_leche')->insert([
                'Codigo_tanque' => $val["Codigo"],
                'Codigo_movimiento' =>$cmv,
                'Cantidad' =>  $val["Cantidad"]
              ]);
            }
          }
        }
        if ($ex_l != null) {
          $pr_c = Produccion_corral::create([
            'Codigo_corral'=>$input['corral'],
            'Codigo_movimiento'=>$cmv,
            'Jornada'=>$input['jornada'],
          ]);
        }
        if ($pr_c != null) {
          $dt_produ = movimiento::where('Codigo', $cmv)->get();

          return json_encode([$dt_produ,"mensaje"=>1]);
        }
      }

    } catch (Exception $e) {
      return json_encode(["mensaje"=>2]);
    }
  }

  public function eliminar_venta(Request $request){
      $id_venta = $request->input("id");

      $ex_leche = Existencia_leche::where('Codigo_movimiento', $id_venta)->get();

      var_dump($ex_leche);



  }

}
