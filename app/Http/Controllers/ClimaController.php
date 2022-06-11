<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clima;

class ClimaController extends Controller
{
    //
    public function indexClima(){
        $respuesta = Clima::orderBy('id','asc')->get();

        return ['respuesta' => $respuesta];
        }

    public function infoClima(Request $request)
    {
        $flag=$request->id;

        $respuesta = Clima::where('id', '=', $flag)->orderBy('id','asc')->get();

        if($respuesta->isNotEmpty()){
            return ['respuesta' => $respuesta];
        }
        else{
            $respuesta="No existen registros con este número";
            return ['respuesta' => $respuesta];
        }
    }
}
