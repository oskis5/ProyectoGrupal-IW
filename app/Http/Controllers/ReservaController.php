<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reserva;

class ReservaController extends Controller
{
    //

    public function index(){
        $reservas = Reserva::all();
        return response()->json($reservas, 200);
    }
    
    public function show($id){
        $reserva = Reserva::find($id);
        if($reserva == null){
            return response()->json('Recurso no disponible' , 404);
        }else{
            return response()->json($reserva, 200);
        }
    }

    public function delete(Request $request, $id){
        $reserva = Reserva::findOrFail($id);
        $reserva->delete();

        return response()->json( null , 204 );
    }

    public function update(Request $request, $id){
        $reserva = Reserva::findOrFail($id);
        $reserva->update($request->all());

        return response()->json( $reserva , 200 );
    }

    public function store(Request $request){
        $reserva = Reserva::create($request->all());
        return response()->json($reserva, 201);
    }
}
