<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estancia;


class EstanciaController extends Controller
{
    public function index()
    {
        $estancias = Estancia::all();
        return response()->json($estancias, 200);
    }
 
    public function show($id){
        $estancia = Estancia::find($id); 
        return response()->json($estancia, 200);
    }

    public function store(Request $request)
    {
        $estancia = Estancia::create($request->all());
        return response()->json($estancia, 200);
    }

    public function update(Request $request, $id)
    {
        $estancia = Estancia::findOrFail($id);
        $estancia->update($request->all());
        return response()->json($estancia, 200);
    }

    public function delete(Request $request, $id)
    {
        $estancia = Estancia::findOrFail($id);
        $estancia->delete();

        return response()->json(null, 204);
    }

}
