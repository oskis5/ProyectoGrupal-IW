<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estancia extends Model
{
    protected $fillable = ['id', 'tipo_id', 'planta', 'puerta', 'nombre', 'descripcion', 'reservada', 'precio_base', 'metros_cuadrados', 'camas', 'capacidad'];
}
