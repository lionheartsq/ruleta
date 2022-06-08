<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tablas;

class TablasController extends Controller
{
    public function indextablas(){
        $respuesta = Tablas::orderBy('id','asc')->get();

        return ['respuesta' => $respuesta];
        }

    public function infotablas(Request $request)
    {
        $flag=$request->id;

        $respuesta = Tablas::where('id', '=', $flag)->orderBy('id','asc')->get();

        if($respuesta->isNotEmpty()){
            return ['respuesta' => $respuesta];
        }
        else{
            $respuesta="No existen registros con este número";
            return ['respuesta' => $respuesta];
        }
    }
}
