<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Relieve;

class RelieveController extends Controller
{
    //
    public function indexRelieve(){
        $respuesta = Relieve::orderBy('id','asc')->get();

        return ['respuesta' => $respuesta];
        }

    public function infoRelieve(Request $request)
    {
        $flag=$request->id;

        $respuesta = Relieve::where('id', '=', $flag)->orderBy('id','asc')->get();

        if($respuesta->isNotEmpty()){
            return ['respuesta' => $respuesta];
        }
        else{
            $respuesta="No existen registros con este número";
            return ['respuesta' => $respuesta];
        }
    }

}
