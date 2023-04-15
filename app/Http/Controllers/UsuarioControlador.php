<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use App\Models\UsuarioModelo;

class UsuarioControlador extends Controller
{
    private $c_reg_panel = 25;
    private $c_reg_lista = 10;



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function nuevo(Request $peticion){
        $username = substr($peticion->input('nombre'),0,1).$peticion->input('apellido');

        try {
            $campos = $this->validate($peticion,[
                'nombre'=>'required|string',
                'apellido'=>'required|string',
                'cedula'=>'required|string',
                'pass'=>'required|string|confirmed',
                'fecha_nacimiento'=>'required|string',
                'email'=>'required|string',
                'perfil_id'=>'required|string',
            ]);

            $campos['restablecer_pass'] = 0;

            $campos['nombre_usuario'] = $this->validarUsuarioUnico($campos['nombre'],$campos['apellido'],$campos['cedula']."");
            $usuario = UsuarioModelo::create($campos);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return ["cod"=>"06","msg"=>"Error al insertar los datos","errores"=>[$e->errors() ]];

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
    public function listarPanel($busqueda="",$pag=0){
        $c_paginas = ceil(UsuarioModelo::count()/$this->c_reg_panel);
        $salto = $pag*$this->c_reg_panel;

        $query = UsuarioModelo::select("usuario.nombre_usuario","usuario.nombre","usuario.apellido","usuario.cedula","usuario.fecha_nacimiento","usuario.email");
        if($busqueda !=""){
            $query = $query->where("usuario.nombre_usuario","like",$busqueda)->orWhere("usuario.nombre","like",$busqueda)->orWhere("usuario.apellido","like",$busqueda)->orWhere("usuario.apellido","like",$busqueda);
        }
        $query = $query->skip($salto)->take($this->c_reg_panel)->orderBy("usuario.nombre_usuario");

        return ["cod"=>"00","msg"=>"todo correcto","pagina_actual"=>$pag,"cantidad_paginas"=>$c_paginas,"datos"=>$query->get()];
    }
    public function listarDesplegable($busqueda){
        $c_paginas = ceil(UsuarioModelo::count()/$this->c_reg_panel);
        $salto = $pag*$this->c_reg_panel;

        $query = UsuarioModelo::select("usuario.nombre_usuario","usuario.nombre","usuario.apellido","usuario.cedula");
        if($busqueda !=""){
            $query = $query->where("usuario.nombre_usuario","like",$busqueda)->orWhere("usuario.nombre","like",$busqueda)->orWhere("usuario.apellido","like",$busqueda)->orWhere("usuario.apellido","like",$busqueda);
        }
        $query = $query->skip(0)->take($this->c_reg_lista)->orderBy("usuario.nombre_usuario");

        return ["cod"=>"00","msg"=>"todo correcto","pagina_actual"=>$pag,"cantidad_paginas"=>$c_paginas,"datos"=>$query->get()];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function modificar(Request $peticion, $id){

        try {
            // return [$request->all(),$id];
            $campos = $this->validate($peticion,[
                'nombre'=>'required|string',
                'apellido'=>'required|string',
                'cedula'=>'required|string',
                'fecha_nacimiento'=>'required|string',
                'email'=>'required|string',
                'perfil_id'=>'required|string',
            ]);

            $usuario = UsuarioModelo::where("nombre_usuario",$id);

            $usuario->update($campos);
            return ["cod"=>"00","msg"=>"todo correcto"];

        } catch (\Illuminate\Validation\ValidationException $e) {
            return ["cod"=>"06","msg"=>"Error validando los datos","errores"=>[$e->errors() ]];

        } catch (\Exception $e) {
            return ["cod"=>"07","msg"=>"Error al actualizar los datos"];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminar($id){
        $eliminar = ["activo"=>"0"];
        try {

            $usuario = UsuarioModelo::where("nombre_usuario",$id);

            $usuario->update($eliminar);

            return ["cod"=>"00","msg"=>"todo correcto"];
        } catch (\Exception $e) {
            return ["cod"=>"08","msg"=>"Error al eliminar el registro"];
        }
    }


    private function validarUsuarioUnico($nombre,$apellido,$cedula){
        $cant_cedula = 3;
        $validar = 1;
        while($validar >0){
            $nombre_usuario= strtolower(substr($nombre,0,1).$apellido.substr($cedula,(strlen($cedula)-$cant_cedula)));
            $validar = UsuarioModelo::where("nombre_usuario",$nombre_usuario)->count();
            $cant_cedula++;
        }
        return $nombre_usuario;

    }
}
