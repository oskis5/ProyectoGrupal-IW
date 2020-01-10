<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TemporadasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *      $table->bigIncrements('id');
            $table->string('nombre');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->float('precio_unitario');
            $table->timestamps();
     * @return void
     */
    public function run()
    {
        DB::table('temporadas')->insert([[
            'nombre' => 'Verano',
            'fecha_inicio' => Carbon::createFromDate(1975, 6, 22),
            'fecha_fin' =>  Carbon::createFromDate(1975, 9, 21),
            'precio_unitario' => 20
        ],
        [
            'nombre' => 'Otoño',
            'fecha_inicio' => Carbon::createFromDate(1975, 9, 22),
            'fecha_fin' =>  Carbon::createFromDate(1975, 12, 21),
            'precio_unitario' => 8
        ],
        [
            'nombre' => 'Invierno',
            'fecha_inicio' => Carbon::createFromDate(1975, 1, 7),
            'fecha_fin' =>  Carbon::createFromDate(1975, 3, 21),
            'precio_unitario' => 12
        ],
        [
            'nombre' => 'Navidad',
            'fecha_inicio' => Carbon::createFromDate(1975, 12, 22),
            'fecha_fin' =>  Carbon::createFromDate(1975, 1, 6),
            'precio_unitario' => 22
        ],
        [
            'nombre' => 'Primavera',
            'fecha_inicio' => Carbon::createFromDate(1975, 3, 22),
            'fecha_fin' =>  Carbon::createFromDate(1975, 6, 21),
            'precio_unitario' => 10
        ]]);
    }
}
