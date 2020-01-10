<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoReserva;

class TipoReservaController extends Controller
{

    public function index()
    {
        $tipoReserva = TipoReserva::all();
        return response()->json($tipoReserva, 200);
    }

    public function show($id){
        $tipoReserva = TipoReserva::find($id);
        if($tipoReserva == null){
            return response()->json('Recurso no disponible' , 404);
        }else{
            return response()->json($tipoReserva, 200);
        }
    }


    public function delete(Request $request, $id){
        $tipoReserva = TipoReserva::findOrFail($id);
        $tipoReserva->delete();
        return response()->json( null , 204 );
    }

    public function update(Request $request, $id){
        $tipoReserva = TipoReserva::findOrFail($id);
        $tipoReserva->update($request->all());
        return response()->json( $tipoReserva , 200 );
    }

    public function store(Request $request){
        $tipoReserva = TipoReserva::create($request->all());
        return response()->json($tipoReserva, 201);
    }
    //
}
