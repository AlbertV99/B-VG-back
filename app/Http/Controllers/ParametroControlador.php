<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParametroModelo;

class ParametroControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function modificar(Request $peticion)
    {
        $campos = $this->validate($peticion,[
            'direccion_mail_saliente'=>'required|string',
            'servidor_mail'=>'required|string',
            'puerto_mail'=>'required|string',
            'pass_mail'=>'required|string|confirmed',
            'interes_bcp'=>'required|string',
            'interes_moratorio'=>'required|string',
            'interes_punitorio'=>'required|string',
        ]);
        try {
            $parametro = ParametroModelo::create($campos);

        } catch (\Exception $e) {
            return ["cod"=>"05","msg"=>"Error al insertar los datos"];
         }
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
