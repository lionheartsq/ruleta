<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hidrografia;

class HidrografiaController extends Controller
{
    //
    public function indexHidrografia(){
        $respuesta = Hidrografia::orderBy('id','asc')->get();

        return ['respuesta' => $respuesta];
        }

    public function infoHidrografia(Request $request)
    {
        $flag=$request->id;

        $respuesta = Hidrografia::where('id', '=', $flag)->orderBy('id','asc')->get();

        if($respuesta->isNotEmpty()){
            return ['respuesta' => $respuesta];
        }
        else{
            $respuesta="No existen registros con este número";
            return ['respuesta' => $respuesta];
        }
    }
}
