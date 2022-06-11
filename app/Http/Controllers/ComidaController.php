<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comida;

class ComidaController extends Controller
{
    //
    public function indexComida(){
        $respuesta = Comida::orderBy('id','asc')->get();

        return ['respuesta' => $respuesta];
        }

    public function infoComida(Request $request)
    {
        $flag=$request->id;

        $respuesta = Comida::where('id', '=', $flag)->orderBy('id','asc')->get();

        if($respuesta->isNotEmpty()){
            return ['respuesta' => $respuesta];
        }
        else{
            $respuesta="No existen registros con este número";
            return ['respuesta' => $respuesta];
        }
    }
    
}
