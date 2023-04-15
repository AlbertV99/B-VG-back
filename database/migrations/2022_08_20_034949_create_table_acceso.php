<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAcceso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acceso', function (Blueprint $table) {
            $table->unsignedBigInteger('perfil_id');
            $table->unsignedBigInteger("entidad_id");
            $table->integer("acceso")->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('acceso', function (Blueprint $table) {
            //
        });
    }
}
