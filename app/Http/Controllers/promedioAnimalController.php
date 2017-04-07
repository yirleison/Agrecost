<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Model\Corral;
use App\Model\animal_corral;
use App\Model\Animal;
use App\Model\promedioAnimal;
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

    //  $datos = $request->all();


    //  for($i=0; $i<count($datos["codigo"]); $i++){

    //     var_dump(json_encode($datos["cantidad"][$i]));

    //     $r = DB::table('promedio_animal')->insert([

    //         "Codigo_animal"=>$datos["codigo"][$i],
    //         "Cantidad_leche"=>$datos["cantidad"][$i]

    //         ]);
    // }$m = DB::table("movimiento")->insertGetId([]);

    }

    public function guardarP(Request $request){


        // Produccion_corral::create([



        //     ]);


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
    //    ->addColumn('Cantidad', function ($variable) {

    //     // $variable = '<input type="text" class="form-control" id="cantidad"/>';

    //     return $variable;

    // })
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
