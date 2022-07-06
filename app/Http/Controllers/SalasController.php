<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Salas;

class SalasController extends Controller
{
    public function crearsalas(Request $request)
    {
        //
        if(!$request->ajax()) return redirect('/');
        $Salas = new Salas();
        $Salas->capacidad_sala=$request->capacidad_sala;
        $Salas->tipo_juego=$request->tipo_juego;
        $Salas->n_puntaje=$request->n_puntaje;
        $Salas->n_turnos=$request->n_turnos;
        $Salas->estado=1;
        $Salas->save();

    }

    public function editarsalas(Request $request)
    {
        //
        if(!$request->ajax()) return redirect('/');
        $Salas = Salas::findOrFail($request->id);
        $Salas->estado=($request->estado)+1;
        $Salas->save();
    }

    public function validarsalas(){
        $respuesta = Salas::orderBy('id','asc')->get();

        return ['respuesta' => $respuesta];
        }

    public function infosalas(){
            $respuesta = Salas::orderBy('id','asc')->get();
    
            return ['respuesta' => $respuesta];
        }        

}
