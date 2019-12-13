<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ReservaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *  Schema::create('reservas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('estancia_id');
            $table->unsignedBigInteger('cliente_id');
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
     * @return void
     */
    public function run()
    {
        DB::table('reservas')->insert([
            [
                'estancia_id' => 1,
                'cliente_id' => 1,
                'tipo_id' => 1,
                'temporada_id' => 3,
                'f_entrada' => Carbon::createFromDate(2019, 12, 12),
                'f_salida' => Carbon::createFromDate(2019, 12, 15),
                'precio_total' => 120
            ],
            [
                'estancia_id' => 5,
                'cliente_id' => 1,
                'tipo_id' => 1,
                'temporada_id' => 3,
                'f_entrada' => Carbon::createFromDate(2019, 2, 14),
                'f_salida' => Carbon::createFromDate(2019, 2, 15),
                'precio_total' => 420
            ],
        ]);   
    }
}
