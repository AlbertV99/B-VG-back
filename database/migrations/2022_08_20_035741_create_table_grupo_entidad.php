<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableGrupoEntidad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupo_entidad', function (Blueprint $table) {
            $table->id();
            $table->string("descripcion");
            $table->string("dsc_imagen")->default("");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('grupo_entidad', function (Blueprint $table) {
            //
        });
    }
}
