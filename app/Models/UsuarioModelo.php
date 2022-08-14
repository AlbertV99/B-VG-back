<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioModelo extends Model{

    public $table = 'usuario';

    protected $fillable =[
        'nombre',
        'apellido',
        'cedula',
        'fecha_nacimiento',
        'email',
        'perfil_id'
    ];

    protected $hidden = [
        'pass',
        'perfil_id'
    ];


}
