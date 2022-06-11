<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Economia;

class EconomiaController extends Controller
{
    //
    public function indexEconomia(){
        $respuesta = Economia::orderBy('id','asc')->get();

        return ['respuesta' => $respuesta];
        }

    public function infoEconomia(Request $request)
    {
        $flag=$request->id;

        $respuesta = Economia::where('id', '=', $flag)->orderBy('id','asc')->get();

        if($respuesta->isNotEmpty()){
            return ['respuesta' => $respuesta];
        }
        else{
            $respuesta="No existen registros con este número";
            return ['respuesta' => $respuesta];
        }
    }
}
