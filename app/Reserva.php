<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    //
    protected $fillable  = [
        'estancia_id' , 'cliente_id' , 'tipo_id' ,
        'temporada_id','f_entrada','f_salida','precio_total'
    ];
}
