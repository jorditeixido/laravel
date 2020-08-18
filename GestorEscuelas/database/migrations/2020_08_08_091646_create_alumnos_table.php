<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');//Campo requerido
            $table->string('apellidos');//Campo requerido
            $table->date('fechaNacimiento');//Campo requerido
            /* 
            PARA TECNOBRAVO
            En un proyecto real habría creado tablas vinculadas de poblaciones
            provincias, etc. Pero por simplicidad del ejercicio
            lo he obviado */ 
            $table->string('ciudad')->nullable();
            $table->integer('escuela_id')->unsigned();
            $table->foreign('escuela_id')->references('id')->on('escuelas');
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
        Schema::dropIfExists('alumnos');
    }
}
