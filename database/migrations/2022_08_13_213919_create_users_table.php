<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->string('nombre_usuario')->unique();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('cedula');
            $table->string('pass');
            $table->date('fecha_nacimiento');
            $table->string('email');
            $table->boolean('restablecer_pass');
            $table->unsignedBigInteger('perfil_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
