<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableEntidad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entidad', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('grupo_entidad_id');
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
        Schema::table('entidad', function (Blueprint $table) {
            //
        });
    }
}
