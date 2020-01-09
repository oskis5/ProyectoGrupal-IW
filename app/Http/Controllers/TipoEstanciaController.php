<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoHabitacione;

class TipoEstanciaController extends Controller
{

    public function index()
    {
        $tipohabitacion = TipoHabitacione::all();
        return response()->json($tipohabitacion, 200);
    }
    public function show($id){
        $tipohabitacion = TipoHabitacione::find($id);
        if($tipohabitacion == null){
            return response()->json('Recurso no disponible' , 404);
        }else{
            return response()->json($tipohabitacion, 200);
        }
    }

    public function delete(Request $request, $id){
        $tipohabitacion = TipoHabitacione::findOrFail($id);
        $tipohabitacion->delete();
        return response()->json( null , 204 );
    }

    public function update(Request $request, $id){
        $tipohabitacion = TipoHabitacione::findOrFail($id);
        $tipohabitacion->update($request->all());
        return response()->json( $tipohabitacion , 200 );
    }

    public function store(Request $request){
        $tipohabitacion = TipoHabitacione::create($request->all());
        return response()->json($tipohabitacion, 201);
    }
}
