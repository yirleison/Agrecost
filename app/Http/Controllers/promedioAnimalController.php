<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Model\Corral;
use App\Model\Corral_animal;
use App\Model\Animal;
use App\Model\promedioAnimal;
use App\Model\Produccion_corral;
use App\Model\Movimiento;
use Notify;

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
    public function store(Request $request)  {
       $datos = $request->all();

       for($i=0; $i<count($datos["codigo"]); $i++){

        var_dump(json_encode($datos["cantidad"][$i]));

        $r = DB::table('promedio_animal')->insert([

            "Codigo_animal"=>$datos["codigo"][$i],
            "Fecha"=>date('Y-m-d'),
            "Cantidad_leche"=>$datos["cantidad"][$i]

            ]);
    }

    $cont = 0;
    $codmovi = null;
    $tq_existencia = [];
    $aux = 0;
    $cantllega=$request->input('total');

    $tanques = DB::table('tanque')->select('tanque.*')
    ->where('Estado','=','Disponible')
    ->orwhere('Estado','=','Lleno')
    ->orderBy('Codigo','ASC')->get()->toArray();

    $cantidad = 0;
    $capacidad = 0;
    $r_t = 0;

    foreach ($tanques as $key => $v) {
        $cantidad+= $v->Cantidad;
        $capacidad+= $v->Capacidad;
    }

    $r_t = ($capacidad -  $cantidad);
    if ($cantllega <= $r_t){

       $codmovi = DB::table('movimiento')->insertGetId([
        'Tipo_movimiento' =>'Produccion',
        'Cantidad' => $cantllega,
        'Fecha' => date('Y-m-d')
        ]);

       if ($codmovi != null) {

        foreach($tanques as $key => $value){
          $updtanque = [];
            // Sumando la cantidad del tanque mas la que llega
          $can_cp = ($value->Cantidad + $cantllega);

          if($can_cp == $value->Capacidad ){

                // Aqui estamos haciendo un array con los campos de dellate movimiento para los reportes e irlo actualizar // despues del ciclo
            array_push($tq_existencia,["Codigo"=>$value->Codigo,"Cantidad"=> $cantllega]);

                // Actualizamos el tanque de acuerdo a la condicion del ciclo
            $cp_u = ["Cantidad" => ($cantllega + $value->Cantidad),"Estado"=>"Lleno"];

            $cantllega = 0;

        }else if ($can_cp < $value->Capacidad) {

            array_push($tq_existencia, ["Codigo"=>$value->Codigo,"Cantidad" => $cantllega]);

            $cp_u = ["Cantidad" => ($cantllega + $value->Cantidad)];

            $aux = $cantllega;

            $cantllega = 0;

        }else if ($can_cp > $value->Capacidad ) {
                // Restamos la capacidad con la cantidad total paraa poder llevarla a otro tanque
            $r_cap = ($can_cp-$value->Capacidad);

            $cp_u = ["Cantidad" => ($value->Capacidad),"Estado"=>"Lleno"];

            array_push($tq_existencia, ["Codigo"=>$value->Codigo,"Cantidad" => $r_cap]);

            $cantllega =   $r_cap;
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
            'Codigo_movimiento' =>$codmovi,
            'Cantidad' =>  $val["Cantidad"]
            ]);
      }
  }
}
if ($ex_l != null) {
  $pr_c = Produccion_corral::create([
    'Codigo_corral'=>$request->input('Corrales'),
    'Codigo_movimiento'=>$codmovi,
    'Jornada'=>$request->input('Jornada'),
    ]);
}
if ($pr_c != null) {
  $dt_produ = movimiento::where('Codigo', $codmovi)->get();   
  return json_encode(["mensaje"=>1]);
  // return Notify::success('Se guardo');

}

}
}else{
  return json_encode(["mensaje"=>2]);
      // return Notify::error('No se guardo');
}
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function get($id){
       $variable=Animal::select('animal.Nombre','animal.Codigo')
       ->join('corral_animal','animal.Codigo','=','corral_animal.Codigo_animal')
       ->where('corral_animal.Codigo_corral','=',$id)
       ->get();

       return Datatables::of($variable)
       ->addColumn('Cantidad',"")
       ->make(true);
   }


   public function show($id){


   }

   public function marcado($id){

    $var=DB::table('Animal')
    ->select('Marcado')
    ->where('Codigo','=',$id)
    ->first(); 

    return json_encode($var);

}

public function tablaPorAnimal($id){

    $variable=promedioAnimal::select('Fecha','Cantidad_leche')->where('Codigo_animal','=',$id)->get(); 
    return Datatables::of($variable)
  
    ->make(true);


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
