<?php

use Illuminate\Database\Seeder;

class TipoEstanciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *  Schema::create('tipo_habitaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->mediumText('descripcion');
            $table->float('precio_tipo');
            $table->timestamps();
        });
     * @return void
     */
    public function run()
    {
        DB::table('tipo_habitaciones')->insert([[
            'nombre' => 'Sencilla',
            'descripcion' => 'Habitación cómoda y elegente con una cama, televisor y Wifi. Cuenta con baño propio y balcón.',
            'precio_tipo' =>  45
        ],
        [
            'nombre' => 'Doble',
            'descripcion' => 'Habitación con cama de matrimonio, minibar y terraza. Acceso gratis al Wifi del hotel, calefacción y baño propio.',
            'precio_tipo' =>  60
        ],
        [
            'nombre' => 'Suite',
            'descripcion' => 'Lujosa habitación de 90 metros cuadrados con dos estancias, salón y dormitorio. Baño con bañera propio, televisor y calefacción.',
            'precio_tipo' =>  115
        ],
        [
            'nombre' => 'Sala de reuniones',
            'descripcion' => 'Sala acomodada para encuentros formales.',
            'precio_tipo' =>  300
        ]
        ]);
    }
}
