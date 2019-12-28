<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estancia;


class EstanciaController extends Controller
{

    public function show($id){
        $estancia = Estancia::find($id); 
        return response()->json($estancia,200);
    }
    
    public function list(){
        return Estancia::all();
    }
}
