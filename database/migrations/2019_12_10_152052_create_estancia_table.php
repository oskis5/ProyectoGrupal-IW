<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstanciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estancia', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tipo_id');
            $table->foreign('tipo_id')->references('id')->on('tipo_habitacion');
            $table->integer('planta');
            $table->integer('puerta');
            $table->string('nombre');
            $table->mediumText('descripcion');
            $table->boolean('reservada');
            $table->float('precio_base');

            //Habitaciones
            $table->float('metros_cuadrados');
            $table->integer('camas');

            //Sala reuniones
            $table->integer('capacidad');
            
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
        Schema::dropIfExists('estancia');
    }
}
