<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioModelo extends Model{

    public $table = 'usuario';

    protected $fillable =[
        'nombre_usuario',
        'nombre',
        'apellido',
        'pass',
        'cedula',
        'fecha_nacimiento',
        'email',
        'perfil_id',
        'restablecer_pass',
        'activo'
    ];

    protected $hidden = [
        'pass',
        'perfil_id'
    ];


}
