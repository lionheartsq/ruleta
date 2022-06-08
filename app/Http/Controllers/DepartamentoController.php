<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departamento;

class DepartamentoController extends Controller
{
    public function indexdepartamento(){
        $respuesta = Departamento::orderBy('id','asc')->get();

        return ['respuesta' => $respuesta];
        }

    public function infodepartamento(Request $request)
    {
        $flag=$request->id;

        $respuesta = Departamento::where('id', '=', $flag)->orderBy('id','asc')->get();

        if($respuesta->isNotEmpty()){
            return ['respuesta' => $respuesta];
        }
        else{
            $respuesta="No existen registros con este número";
            return ['respuesta' => $respuesta];
        }
    }
}
