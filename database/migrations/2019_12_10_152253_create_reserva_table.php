<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('estancia_id');
            $table->unsignedBigInteger('cliente_id')->nullable(true);
            $table->unsignedBigInteger('tipo_id');
            $table->unsignedBigInteger('temporada_id');
            $table->date('f_entrada');
            $table->date('f_salida');
            $table->foreign('estancia_id')->references('id')->on('estancias');
            $table->foreign('cliente_id')->references('id')->on('users');
            $table->float('precio_total');
            $table->foreign('tipo_id')->references('id')->on('tipo_reservas');
            $table->foreign('temporada_id')->references('id')->on('temporadas');
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
        Schema::dropIfExists('reservas');
    }
}
