<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEscuelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escuelas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');//Campo requerido
            /* 
            PARA TECNOBRAVO
            En un proyecto real habría creado tablas vinculadas de poblaciones
            provincias, códigos postal etc. Pero por simplicidad del ejercicio
            lo he obviado */ 
            $table->text('direccion');//Campo requerido
            $table->string('logotipo')->nullable();//Contiene URL pública
            $table->string('email')->nullable();
            $table->string('telefono')->nullable();
            $table->string('paginaWeb')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('escuelas');
    }
}
