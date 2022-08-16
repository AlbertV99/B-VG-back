<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsuarioModelo;

class UsuarioControlador extends Controller
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
    public function nuevo(Request $peticion){
        $username = substr($peticion->input('nombre'),0,1).$peticion->input('apellido');
        // return ["nombre_usuario"=>$username];

        $campos = $this->validate($peticion,[
            'nombre'=>'required|string',
            'apellido'=>'required|string',
            'cedula'=>'required|string',
            'pass'=>'required|string|confirmed',
            'fecha_nacimiento'=>'required|string',
            'email'=>'required|string',
            'perfil_id'=>'required|string',
        ]);
         try {
            $campos['nombre_usuario'] = $this->validarUsuarioUnico($campos['nombre'],$campos['apellido'],$campos['cedula']."");
            $campos['restablecer_pass']=0;
            $usuario = UsuarioModelo::create($campos);

        } catch (\Exception $e) {
            return ["cod"=>"05","msg"=>"Error al insertar los datos"];
         }

        return ["cod"=>"00","msg"=>"todo correcto"];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function listarPanel($busqueda="",$filtros=[]){
        $temp = UsuarioModelo::select("usuario.nombre","usuario.apellido");
        return ["cod"=>"00","msg"=>"todo correcto","pagina_actual"=>"0","cantidad_paginas"=>"0","datos"=>$temp];
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


    private function validarUsuarioUnico($nombre,$apellido,$cedula){
        $cant_cedula = 3;
        $validar = 1;
        while($validar >0){
            $nombre_usuario= substr($nombre,0,1).$apellido.substr($cedula,(strlen($cedula)-$cant_cedula));
            $validar = UsuarioModelo::where("nombre_usuario","")->count();
            $cant_cedula++;
        }
        return $nombre_usuario;

    }
}
