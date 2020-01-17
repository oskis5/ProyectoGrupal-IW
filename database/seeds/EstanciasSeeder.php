<?php

use Illuminate\Database\Seeder;

class EstanciasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *   Schema::create('estancias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tipo_id');
            $table->foreign('tipo_id')->references('id')->on('tipo_habitaciones');
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
     * @return void
     */
    public function run()
    {
        DB::table('estancias')->insert([
            [
                'tipo_id' => 1,
                'planta' => 1,
                'puerta' => 1,
                'reservada' => false,
                'metros_cuadrados' => 0,
                'camas' => 1,
                'nombre' => 'Habitación 101',
                'descripcion' => '',
                'precio_base' => 0,
                'capacidad' => 0
            ],
            [
                'tipo_id' => 1,
                'planta' => 2,
                'puerta' => 1,
                'reservada' => false,
                'metros_cuadrados' => 22,
                'camas' => 1,
                'nombre' => 'Habitación 201',
                'descripcion' => '',
                'precio_base' => 0,
                'capacidad' => 0
            ],
            [
                'tipo_id' => 2,
                'planta' => 1,
                'puerta' => 2,
                'reservada' => false,
                'metros_cuadrados' => 25,
                'camas' => 1,
                'nombre' => 'Habitación 202',
                'descripcion' => '',
                'precio_base' => 0,
                'capacidad' => 0
            ],
            [
                'tipo_id' => 1,
                'planta' => 2,
                'puerta' => 3,
                'reservada' => false,
                'metros_cuadrados' => 20,
                'camas' => 1,
                'nombre' => 'Habitación 202',
                'descripcion' => 'Esta habitación tiene vistas al mar.',
                'precio_base' => 0,
                'capacidad' => 0
            ],
            [
                'tipo_id' => 3,
                'planta' => 3,
                'puerta' => 1,
                'reservada' => false,
                'metros_cuadrados' => 90,
                'camas' => 2,
                'nombre' => 'Suite Jordi Ferrer',
                'descripcion' => 'Esta sala está especialmente equipada para el amor.',
                'precio_base' => 0,
                'capacidad' => 0
            ],
            [
                'tipo_id' => 4,
                'planta' => 0,
                'puerta' => 1,
                'reservada' => false,
                'metros_cuadrados' => 150,
                'camas' => 0,
                'nombre' => 'Sala Vanesa Lara',
                'descripcion' => 'Gran sala de reuniones con butacas y proyector.',
                'precio_base' => 0,
                'capacidad' => 100 
            ],
            [
                'tipo_id' => 4,
                'planta' => 0,
                'puerta' => 2,
                'reservada' => false,
                'metros_cuadrados' => 20,
                'camas' => 0,
                'nombre' => 'Sala Fran Piñero',
                'descripcion' => 'Sala para pequeñas reuniones informales con mesa, sillones y ordenador.',
                'precio_base' => 0,
                'capacidad' => 20 
            ]
        ]);
    }
}