<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParametroModelo extends Model{
   
    public $table = 'parametros';

    protected $fillable =[
        'direccion_mail_saliente',
        'servidor_mail',
        'puerto_mail',
        'pass_mail',
        'interes_bcp',
        'interes_moratorio',
        'interes_punitorio'
    ];

    protected $hidden =[
        'pass_mail'
    ];
}
