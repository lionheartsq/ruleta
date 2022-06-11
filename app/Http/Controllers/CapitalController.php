<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Capital;

class CapitalController extends Controller
{
    //
    public function indexCapital(){
        $respuesta = Capital::orderBy('id','asc')->get();

        return ['respuesta' => $respuesta];
        }

    public function infoCapital(Request $request)
    {
        $flag=$request->id;

        $respuesta = Capital::where('id', '=', $flag)->orderBy('id','asc')->get();

        if($respuesta->isNotEmpty()){
            return ['respuesta' => $respuesta];
        }
        else{
            $respuesta="No existen registros con este número";
            return ['respuesta' => $respuesta];
        }
    }
}
