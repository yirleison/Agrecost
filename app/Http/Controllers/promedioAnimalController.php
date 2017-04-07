<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Model\Corral;
use App\Model\Corral_animal;
use App\Model\Animal;
use App\Model\Promedio_animal;
use App\Model\Produccion_corral;
use Datatables;



class promedioAnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $input=Corral::pluck('Tipo','Codigo');


        return view('promedio.registrar_promedio',compact('input'));

    }

    public function vistapromedio_animal(){

        $ani= Animal::pluck('Nombre','Codigo'); 
        return view('promedio.promedio_por_animal',compact('ani'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     $datos = $request->all();

     for($i=0; $i<count($datos["codigo"]); $i++){

        var_dump(json_encode($datos["cantidad"][$i]));

        $r = DB::table('promedio_animal')->insert([

            "Codigo_animal"=>$datos["codigo"][$i],
            "Fecha"=>date('Y-m-d'),
            "Cantidad_leche"=>$datos["cantidad"][$i]

            ]);

    }
    
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
     // 

}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function get($id){
       $variable=Animal::select('Animal.Nombre','Animal.Codigo')
       ->join('corral_animal','Animal.Codigo','=','corral_animal.Codigo_animal')
       ->where('corral_animal.Codigo_corral','=',$id)
       ->get();

       return Datatables::of($variable)  
       ->addColumn('Cantidad',"")     
       ->make(true); 
   }


   public function show($id){


   }

   public function marcado($id){



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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
