<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\TiposVacunacion;
use App\Model\Vacunacion;
use App\Model\Existenciavacunas;
use Datatables;
use Notify;
use DB;

class vacunacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $input=TiposVacunacion::pluck('Nombre','Codigo');
        $input1=Vacunacion::pluck('Nombre','Codigo');

        return view('vacunacion.vacunacion',compact('input','input1'));
    }


    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function createTipovacuna(Request $re){


        $query= DB::table('Tipo_vacuna')

        ->insert([
            'Nombre'=>$re->input('Nom')

            ]);
    
        


    }


    public function store(Request $request)
    {

        Vacunacion::create([
            "Nombre"=>$request->input('Nombre'),
            "Tipo"=>$request->input('Tipo'),
            "Periodicidad"=>$request->input('Periodicidad'),
            "Dosis"=>$request->input('Dosis'),
            "Tipo_administracion"=>$request->input('Tipo_administracion'),
            "Stock"=>$request->input('Stock')
            
            ]);

    }



    public function listar(){
         $tabla=Existenciavacunas::select('existencia_vacunas.*','vacunacion.*')
        ->join('vacunacion','vacunacion.Codigo','=','existencia_vacunas.Codigo_vacunacion')
        // ->join('tipo','tipo.Codigo','=','vacu.Tipo')       
        ->get();
       
        return Datatables::of($tabla)
        ->addColumn('action', function ($tabla) {
            // Boton de la vista en detalle del listar
            $btnVistadetalle='<a href="#" class="btn btn-xs btn-primary" onclick="vacunacion_js.vacunacion_editar('.$tabla->Codigo.')"><i class="glyphicon glyphicon-edit"></i> Vista en detalle</a>';

            $btnEliminar='<a href="#" class="btn btn-xs btn-danger" onclick="vacunacion_js.vacunacion_eliminar('.$tabla->Codigo.')"><i class="glyphicon glyphicon-edit"></i> Eliminar</a>';

            return $btnVistadetalle.$btnEliminar;
        })
        ->make(true);    
    }







    public function viewListar(){

        $input=TiposVacunacion::pluck('Nombre','Codigo');

        return view('vacunacion.listar',compact('input'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {      

        $tabla=Existenciavacunas::select('Existencia_vacunas.*','vacunacion.*')
        ->join('vacunacion','vacunacion.Codigo','=','Existencia_vacunas.Codigo_vacunacion')
        // ->join('Tipo_vacuna','Tipo_vacuna.Codigo','=','vacunacion.Tipo')
        ->where('Existencia_vacunas.Codigo_vacunacion','=',$id)
        ->get();

        // $tabla=Vacunacion::select('Vacunacion.*','Tipo_vacuna.Codigo as Tipo_vacuna','existencia_vacunas.* as existencia')
        // ->join('Tipo_vacuna','Tipo_vacuna.Codigo','=','Vacunacion.Tipo')
        // ->join('existencia','existencia.')
        // ->where('vacunacion.Codigo','=',$id)
        // ->get();


        return json_encode($tabla);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {


    }

    public function actualizar(Request $re, $id){
        if ($re -> ajax()){

            $vacu=Vacunacion::select('vacunacion.*')->where('vacunacion.Codigo','=',$id)->first();

            if($vacu != null){


                $query= DB::table('vacunacion')
                ->where('Codigo','=',$id)
                ->update([
                    'Nombre'=>$re->input('Nom'),
                    'Tipo'=>$re->input('Tipo'),
                    'Periodicidad'=>$re->input('perio'),
                    'Dosis'=>$re->input('Dosis'),
                    'Tipo_administracion'=>$re->input('T_Admin'),
                    'Stock'=>$re->input('Stock')
                    ]);
                

                return json_encode([  "mensaje" => 1 ]);
            }else{
                return json_encode([  "mensaje" => 3 ]);
            }



        }else{

            return json_encode([  "mensaje" => 1 ]);
        }

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     $vacuna=Vacunacion::select('Vacunacion.*')->where('Vacunacion.Codigo','=',$id)->delete();
     return json_encode(["mensaje" == 1]);
 }


}
