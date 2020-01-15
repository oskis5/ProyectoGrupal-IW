<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Temporada;

class TemporadasController extends Controller
{
    public function index()
    {
        $temporada = Temporada::all();
        return response()->json($temporada, 200);
    }

    public function show($id){
        $temporada = Temporada::find($id);
        if($temporada == null){
            return response()->json('Recurso no disponible' , 404);
        }else{
            return response()->json($temporada, 200);
        }
    }


    public function delete(Request $request, $id){
        $temporada = Temporada::findOrFail($id);
        $temporada->delete();
        return response()->json( null , 204 );
    }

    public function update(Request $request, $id){
        $temporada = Temporada::findOrFail($id);
        $temporada->update($request->all());
        return response()->json( $temporada , 200 );
    }

    public function store(Request $request){
        $temporada = Temporada::create($request->all());
        return response()->json($temporada, 201);
    }

    
}
