<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoHabitacion;

class TipoEstanciaController extends Controller
{

    public function index()
    {
        $tipohabitacion = TipoHabitacion::all();
        return response()->json($tipohabitacion, 200);
    }

    public function show($id){
        $tipohabitacion = TipoHabitacion::find($id);
        if($tipohabitacion == null){
            return response()->json('Recurso no disponible' , 404);
        }else{
            return response()->json($tipohabitacion, 200);
        }
    }


    public function delete(Request $request, $id){
        $tipohabitacion = TipoHabitacion::findOrFail($id);
        $tipohabitacion->delete();
        return response()->json( null , 204 );
    }

    public function update(Request $request, $id){
        $tipohabitacion = TipoHabitacion::findOrFail($id);
        $tipohabitacion->update($request->all());
        return response()->json( $tipohabitacion , 200 );
    }

    public function store(Request $request){
        $tipohabitacion = TipoHabitacion::create($request->all());
        return response()->json($tipohabitacion, 201);
    }
}
