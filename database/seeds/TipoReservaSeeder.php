<?php

use Illuminate\Database\Seeder;

class TipoReservaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *  Schema::create('tipo_reservas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('nombre');
            $table->mediumText('descripcion');
            $table->float('precio');
            $table->integer('tipo_estancia')->nullable(false);
        });
     * @return void
     */
    public function run()
    {
        DB::table('tipo_reservas')->insert([
        [
            'nombre' => 'Solo estancia',
            'descripcion' => 'Para clientes de paso, sin derecho a desayuno o comidas.',
            'precio' =>  0,
            'tipo_estancia' => 1
        ],
        [
            'nombre' => 'Desayuno incluido',
            'descripcion' => 'Incluye un buffet libre de 07:00 a 11:00.',
            'precio' =>  10,
            'tipo_estancia' => 1
        ],
        [
            'nombre' => 'Media pensión',
            'descripcion' => 'Desayuno y comida en el restaurante del hotel.',
            'precio' =>  18,
            'tipo_estancia' => 1
        ],
        [
            'nombre' => 'Pensión completa',
            'descripcion' => 'Desayuno, comida y cena incluidas',
            'precio' =>  30,
            'tipo_estancia' => 1
        ]
        ]);
    }
}
