<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Baile;

class BaileController extends Controller
{
    //
    public function indexbaile(){
        $respuesta = Baile::orderBy('id','asc')->get();

        return ['respuesta' => $respuesta];
        }

    public function infobaile(Request $request)
    {
        $flag=$request->id;

        $respuesta = Baile::where('id', '=', $flag)->orderBy('id','asc')->get();

        if($respuesta->isNotEmpty()){
            return ['respuesta' => $respuesta];
        }
        else{
            $respuesta="No existen registros con este número";
            return ['respuesta' => $respuesta];
        }
    }
}
