<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\razaRequest;
use App\Model\Raza;
use App\Http\Controllers\Controller;
use Notify;
use DB;

class razaController extends Controller
{
    public function index()
    {
        $Raza = Raza::all();
        return view('Raza.accionesRaza' ,compact('Raza'));
    }

    public function create()
    {
    }

    public function store(razaRequest $request)
    {
        $accion=$request->get('Accion');
        
        if($accion=='Modificar')
        {
            $id=$request->input("Raza");
            $datos = [
            'Nombre' => $request->input('nuevaRaza'),
            ];
            DB::table('raza')
            ->where('Codigo', $id)
            ->update($datos);
            Notify::Info("Cambios Realizados Con Exito","Raza");
            return redirect()->route('Raza.index');
        }
        elseif($accion=='Eliminar')
        {
            try {
                $id=$request->input("Raza");
                DB::table('raza')
                ->where('Codigo', $id)
                ->delete();
                Notify::Success("Datos Eliminados con Exito","Raza");
                return redirect()->route('Raza.index');
            } catch (\  Exception $e) {
                Notify::Error("La Raza Esta Siendo Utilizada Por Un Animal","Error");
                return redirect()->route('Raza.index');
            }
        }
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
